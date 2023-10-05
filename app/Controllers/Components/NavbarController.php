<?php

namespace App\Controllers\Components;

use App\Controllers\BaseController;

class NavbarController extends BaseController
{
    public function index(): string
    {
        $navbarStory = $this->storyblok->client->getStoryBySlug('navbar')->getBody();

        $component = $navbarStory['story']['content'];

        $navbarModelClass = $this->storyblok->getModelFromComponent($component['component']);
        $navbar = new $navbarModelClass($component);

        $navbarView = $this->storyblok->getViewFromComponent($component['component']);

        return view($navbarView, [
            'component' => $navbar,
            'story' => $navbarStory['story'],
        ]);
    }
}
