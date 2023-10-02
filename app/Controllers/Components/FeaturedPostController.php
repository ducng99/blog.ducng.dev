<?php

namespace App\Controllers\Components;

use App\Controllers\BaseController;
use App\Libraries\Storyblok;

class FeaturedPostController extends BaseController
{
    public function show(string $postID)
    {
        $story = $this->storyblok->client->getStoryByUuid($postID)->getBody();
        $componentModelClass = Storyblok::getModelFromComponent($story['story']['content']['component']);
        $component = new $componentModelClass($story['story']['content']);

        return view('components/featured_post', [
            'component' => $component,
            'story' => $story['story'],
            'postLoaded' => true,
        ]);
    }
}
