<?php

namespace App\Controllers;

use App\Libraries\Storyblok;

class PostController extends BaseController
{
    private const DEFAULT_SEARCH_PARAMS = [
        'q' => '',
        'categories' => [],
        'per_page' => 8,
        'page' => 1,
    ];

    public function index(): string
    {
        $story = $this->storyblok->client->getStoryBySlug('posts')->getBody();
        $component = $story['story']['content'];

        $componentModelClass = Storyblok::getModelFromComponent($component['component']);
        $componentModel = new $componentModelClass($component);

        $viewName = Storyblok::getViewFromComponent($component['component']);
        $categories = $this->getCategories();
        $searchResults = $this->search();

        return view($viewName, [
            'component' => $componentModel,
            'story' => $story['story'],
            'categories' => $categories,
            'searchResults' => $searchResults,
            'searchParams' => $this->getSearchParams(),
        ]);
    }

    public function search(): string
    {
        $searchParams = $this->getSearchParams();

        // Push new URL to browser's history using HTMX
        $urlParams = http_build_query([
            'q' => $searchParams['q'],
            'categories' => $searchParams['categories'],
            'per_page' => $searchParams['per_page'],
            'page' => $searchParams['page'],
        ]);

        $this->response->setHeader('HX-Push-Url', base_url('posts?' . $urlParams));

        $storyblokParams = [
            'starts_with' => 'posts/',
            'content_type' => 'post',
            'search_term' => $searchParams['q'],
            'per_page' => $searchParams['per_page'],
            'page' => $searchParams['page'],
        ];

        if (count($searchParams['categories']) > 0)
        {
            $storyblokParams['filter_query'] = [
                'categories' => [
                    'any_in_array' => implode(',', array_map(function (string $uuid)
                    {
                        return esc($uuid, 'url');
                    }, $searchParams['categories'])),
                ],
            ];
        }

        $searchResults = $this->storyblok->client->getStories($storyblokParams)->getBody();

        $totalPages = ($this->storyblok->client->getHeaders()['Total'][0] ?? 0) / $searchParams['per_page'];

        if (!empty($searchResults['stories']))
        {
            $searchResults = array_map(function (array $story): string
            {
                $component = $story['content'];
                $componentModelClass = Storyblok::getModelFromComponent($component['component']);
                $componentModel = new $componentModelClass($component);

                $viewName = Storyblok::getViewFromComponent('featured_post');

                return view($viewName, [
                    'component' => $componentModel,
                    'story' => $story,
                    'postLoaded' => true,
                ]);
            }, $searchResults['stories']);

            return implode('', $searchResults)
                . view('components/posts_search/pagination', [
                    'searchParams' => $searchParams,
                    'totalPages' => $totalPages,
                ]);
        }

        return "No posts found.";
    }

    /**
     * Get search params from GET request
     * Validate params and set default values if invalid
     */
    private function getSearchParams(): array
    {
        $searchParams = [];
        $searchParams['q'] = $this->request->getGet('q');
        $searchParams['categories'] = $this->request->getGet('categories');
        $searchParams['per_page'] = $this->request->getGet('per_page');
        $searchParams['page'] = $this->request->getGet('page');

        if (intval($searchParams['page']) < 1)
        {
            $searchParams['page'] = self::DEFAULT_SEARCH_PARAMS['page'];
        }
        else
        {
            $searchParams['page'] = intval($searchParams['page']);
        }

        if (!is_array($searchParams['categories']))
        {
            $searchParams['categories'] = self::DEFAULT_SEARCH_PARAMS['categories'];
        }

        if (intval($searchParams['per_page']) < 1)
        {
            $searchParams['per_page'] = self::DEFAULT_SEARCH_PARAMS['per_page'];
        }
        else
        {
            $searchParams['per_page'] = max(1, min(16, $searchParams['per_page']));
        }

        return $searchParams;
    }

    private function getCategories(): mixed
    {
        $categoriesLink = $this->storyblok->client->getLinks([
            'starts_with' => 'categories/',
        ])->getBody();

        $removed_ids = [];
        $categories = [];

        function processCategory(array $categoriesLinks, array &$removed_ids, int $parent_id = 0)
        {
            $ret_categories = [];

            foreach ($categoriesLinks as &$category)
            {
                if (!in_array($category['id'], $removed_ids) && ($parent_id == 0 || $category['parent_id'] === $parent_id))
                {
                    if ($parent_id > 0)
                    {
                        $removed_ids[] = $category['id'];
                    }

                    $ret_categories[$category['id']] = [
                        'item' => $category,
                        'children' => processCategory($categoriesLinks, $removed_ids, $category['id']),
                    ];
                }
            }

            unset($category);

            return $ret_categories;
        }

        $categories = processCategory($categoriesLink['links'], $removed_ids);
        // Filter out top-level categories which key is in $removed_ids
        $categories = array_filter($categories, function ($key) use ($removed_ids)
        {
            return !in_array($key, $removed_ids);
        }, ARRAY_FILTER_USE_KEY);

        return $categories;
    }
}
