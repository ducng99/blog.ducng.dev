<?php

namespace App\Controllers;

use App\Libraries\Storyblok;

class PostController extends BaseController
{
    private const SEARCH_PARAMS = [
        'q' => '',
        'categories' => [],
        'per_page' => 4,
        'page' => 1,
    ];

    public function index(): string
    {
        $story = $this->storyblok->client->getStoryBySlug('posts')->getBody();
        $component = $story['story']['content'];

        $componentModelClass = Storyblok::getModelFromComponent($component['component']);
        $componentModel = new $componentModelClass($component);

        $viewName = Storyblok::getViewFromComponent($component['component']);
        $searchResults = $this->search();

        return view($viewName, [
            'component' => $componentModel,
            'story' => $story['story'],
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

        $searchResults = $this->storyblok->client->getStories([
            'starts_with' => 'posts/',
            'content_type' => 'post',
            'search_term' => $searchParams['q'],
            'per_page' => $searchParams['per_page'],
            'page' => $searchParams['page'],
            'filter_query' => [
                'categories' => [
                    'any_in_array' => $searchParams['categories'],
                ]
            ]
        ])->getBody();

        $totalPages = ($this->storyblok->client->responseHeaders['total'] ?? 0) / $searchParams['per_page'];

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

            return implode('', $searchResults);
        }

        return "No posts found.";
    }

    private function getSearchParams(): array
    {
        $searchParams = [];
        $searchParams['q'] = $this->request->getGet('q');
        $searchParams['categories'] = $this->request->getGet('categories');
        $searchParams['per_page'] = $this->request->getGet('per_page');
        $searchParams['page'] = $this->request->getGet('page');

        if (intval($searchParams['page']) < 1)
        {
            $searchPage = self::SEARCH_PARAMS['page'];
        }

        if (is_array($searchParams['categories']))
        {
            $searchParams['categories'] = implode(',', $searchParams['categories']);
        }
        else
        {
            $searchParams['categories'] = self::SEARCH_PARAMS['categories'];
        }

        if (intval($searchParams['per_page']) < 1)
        {
            $searchParams['per_page'] = self::SEARCH_PARAMS['per_page'];
        }
        else
        {
            $searchParams['per_page'] = max(1, min(16, $searchParams['per_page']));
        }

        return $searchParams;
    }
}
