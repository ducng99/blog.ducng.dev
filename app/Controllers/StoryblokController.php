<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Storyblok;
use CodeIgniter\HTTP\ResponseInterface;

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

    public function clearCache(): ResponseInterface
    {
        $slug = $this->request->getVar('full_slug');

        if (!empty($slug))
        {
            $this->storyblok->client->deleteCacheBySlug($slug);
            return $this->response->setStatusCode(200);
        }

        return $this->response->setStatusCode(400);
    }
}
