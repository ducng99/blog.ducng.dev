<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Storyblok;

class StoryblokController extends BaseController
{
    /**
     * Loads a custom story object from Storyblok Bridge
     */
    public function show(): string
    {
        if (ENVIRONMENT !== 'production')
        {
            // Get story from POST
            $story = $this->request->getJSON(true);

            $component = $story['content'];

            $componentModelClass = Storyblok::getModelFromComponent($component['component']);
            $componentModel = new $componentModelClass($component);

            $viewName = Storyblok::getViewFromComponent($component['component']);

            return view($viewName, [
                'component' => $componentModel,
                'story' => $story,
            ]);
        }

        return view('empty');
    }
}
