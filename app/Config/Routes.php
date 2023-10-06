<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

// Home page
$routes->get('/', 'PageController::show/home');

$routes->group('components', static function (RouteCollection $routes)
{
    $routes->get('featured_post/(:uuid)', 'Components\FeaturedPostController::show/$1');
});

$routes->post('storyblok_load_story', 'StoryblokController::show');

// Catch all pages
$routes->get('/(:any)', 'PageController::show/$1');
