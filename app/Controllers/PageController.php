<?php

namespace App\Controllers;

use App\Libraries\Storyblok;

class PageController extends BaseController
{
    /**
     * @param string[] $segments
     */
    public function show(...$segments): string
    {
        $slug = implode('/', $segments);

        $story = $this->storyblok->client->getStoryBySlug($slug)->getBody();
        $component = $story['story']['content'];

        $componentModelClass = Storyblok::getModelFromComponent($component['component']);
        $componentModel = new $componentModelClass($component);

        $viewName = Storyblok::getViewFromComponent($component['component']);

        return view($viewName, [
            'component' => $componentModel,
            'story' => $story['story'],
        ]);
    }
}
