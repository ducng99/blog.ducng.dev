<?php

use App\Libraries\Storyblok;

/** @var App\Models\Components\Footer $component */
?>

<?= $component->_editable ?>
<footer class="lg:container lg:mx-auto lg:max-w-5xl px-4 lg:px-0 mt-8">
    <?php
    foreach ($component->body as $nestedComponent)
    {
        $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        echo view($viewName, ['component' => $nestedComponent]);
    }
    ?>
</footer>
