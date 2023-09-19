<?php

namespace App\Libraries;

use Storyblok\Client;

class Storyblok
{
    public readonly Storyblok\Client $client;

    public function __construct()
    {
        $this->client = new Client(config('storyblok.api_key'));
        $this->client->editMode(env('CI_ENVIRONMENT') !== 'production');
    }
}
