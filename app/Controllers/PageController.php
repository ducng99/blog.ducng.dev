<?php

namespace App\Controllers;

use App\Libraries\Storyblok;

class PageController extends BaseController
{
    public function show(string $slug): string
    {
        if (empty($slug))
        {
            $slug = 'home';
        }

        $story = $this->storyblok->client->getStoryBySlug($slug)->getBody();
        $component = $story['story']['content'];

        $componentModelClass = Storyblok::getModelFromComponent($component['component']);
        $componentModel = new $componentModelClass($component);

        $viewName = Storyblok::getViewFromComponent($component['component']);

        return view($viewName, [
            'component' => $componentModel,
        ]);
    }
}
