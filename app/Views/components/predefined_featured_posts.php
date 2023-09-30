<?php

/** @var \App\Models\Components\PredefinedFeaturedPosts $component */

echo $component->_editable;

foreach ($component->posts as $post)
{
	echo view('components/featured_post', ['component' => $post]);
}
