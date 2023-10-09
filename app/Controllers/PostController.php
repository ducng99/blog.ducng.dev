<?php

namespace App\Controllers;

use App\Libraries\Storyblok;

class PostController extends BaseController
{
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
            'searchParams' => $this->request->getGet(),
        ]);
    }

    public function search(): string
    {
        $searchPage = $this->request->getGet('page');
        if (empty($searchPage))
        {
            $searchPage = 1;
        }

        $searchTerm = $this->request->getGet('q');

        $searchCategories = $this->request->getGet('categories');
        if (is_array($searchCategories))
        {
            $searchCategories = implode(',', $searchCategories);
        }

        $searchPerPage = $this->request->getGet('per_page');
        if (empty($searchPerPage))
        {
            $searchPerPage = 4;
        }
        else if ($searchPerPage > 16)
        {
            $searchPerPage = 16;
        }

        // Push new URL to browser's history using HTMX
        $urlParams = http_build_query([
            'q' => $searchTerm,
            'categories' => $searchCategories,
            'per_page' => $searchPerPage,
            'page' => $searchPage,
        ]);

        $this->response->setHeader('HX-Push-Url', base_url('posts?' . $urlParams));

        $searchResults = $this->storyblok->client->getStories([
            'starts_with' => 'posts/',
            'content_type' => 'post',
            'search_term' => $searchTerm,
            'per_page' => $searchPerPage,
            'filter_query' => [
                'categories' => [
                    'any_in_array' => $searchCategories
                ]
            ]
        ])->getBody();

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
}
