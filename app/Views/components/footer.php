<?php

use App\Libraries\Storyblok;

/** @var App\Models\Components\Footer $component */
?>

<?= $component->_editable ?>
<footer class="my_container mt-8">
    <?php
    foreach ($component->body as $nestedComponent)
    {
        $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        echo view($viewName, ['component' => $nestedComponent]);
    }
    ?>
</footer>
