<?php

namespace App\Controllers\Components;

use App\Controllers\BaseController;

class FooterController extends BaseController
{
    public function index(): string
    {
        $footerStory = $this->storyblok->client->getStoryBySlug('footer')->getBody();

        $component = $footerStory['story']['content'];

        $footerModelClass = $this->storyblok->getModelFromComponent($component['component']);
        $navbar = new $footerModelClass($component);

        $footerView = $this->storyblok->getViewFromComponent($component['component']);

        return view($footerView, [
            'component' => $navbar,
            'story' => $footerStory['story'],
        ]);
    }
}
