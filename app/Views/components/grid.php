<?php

/** @var \App\Models\Components\Grid $component */

use App\Libraries\Storyblok;
?>

<? if (is_array($component->body)) : ?>
<?= $component->_editable ?>
    <div class="grid grid-cols-<?= esc($component->num_columns, 'attr') ?>">
        <?
        foreach ($component->body as $nestedComponent) :
            $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        ?>
            <div>
                <?= view($viewName, ['component' => $nestedComponent]) ?>
            </div>
        <?
        endforeach;
        ?>
    </div>
<? endif; ?>
