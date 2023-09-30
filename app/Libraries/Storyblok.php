<?php

namespace App\Libraries;

use Exception;
use \Storyblok\Client;
use \Storyblok\RichtextRender\Resolver;

class Storyblok
{
    public readonly Client $client;
    private static ?Resolver $resolver = null;

    public function __construct()
    {
        $api_key = getenv('STORYBLOK_API_KEY');
        if ($api_key === false)
        {
            throw new Exception('STORYBLOK_API_KEY is not set');
        }

        $this->client = new Client($api_key);
        $this->client->editMode(getenv('CI_ENVIRONMENT') !== 'production');
        $this->client->setCache('filesystem', [
            'path' => config('Cache')->file['storePath'],
            'default_lifetime' => getenv('CI_ENVIRONMENT') === 'production' ? 21600 : 300,
        ]);
    }

    /**
     * Rich body renderer
     */
    public static function resolver(): Resolver
    {
        return self::$resolver ??= new Resolver();
    }

    /**
     * Map Storyblok component to view
     * If the component does not match any view, an empty view will be returned
     * @param string $component Storyblok component name
     * @return string View name
     */
    public static function getViewFromComponent(string $component): string
    {
        return match ($component)
        {
            "page" => "page",
            "post" => "post",
            "grid" => "components/grid",
            "featured_post" => "components/featured_post",
            "rich_body" => "components/rich_body",
            "predefined_featured_posts" => "components/predefined_featured_posts",
            default => "empty",
        };
    }

    /**
     * Map Storyblok component to model class.
     * If the component does not match any model, an empty base model will be returned
     * @param string $component Storyblok component name
     * @return string Model class name
     */
    public static function getModelFromComponent(string $component): string
    {
        return match ($component)
        {
            "page" => \App\Models\Page::class,
            "post" => \App\Models\Post::class,
            "grid" => \App\Models\Components\Grid::class,
            "featured_post" => \App\Models\Components\FeaturedPost::class,
            "rich_body" => \App\Models\Components\RichBody::class,
            "predefined_featured_posts" => \App\Models\Components\PredefinedFeaturedPosts::class,
            default => \App\Models\BaseModel::class,
        };
    }
}
