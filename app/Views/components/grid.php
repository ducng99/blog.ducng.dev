<?php

use App\Libraries\Storyblok;

/** @var \App\Models\Components\Grid $component */
?>

<? if (is_array($component->body)) : ?>
    <?= $component->_editable ?>
    <div class="grid grid-cols-1 md:grid-cols-<?= esc($component->num_columns, 'attr') ?> gap-8">
        <?
        foreach ($component->body as $nestedComponent) :
            $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        ?>
            <? if ($component->wrap_item) : ?>
                <div>
                <? endif; ?>
                <?= view($viewName, ['component' => $nestedComponent]) ?>
                <? if ($component->wrap_item) : ?>
                </div>
            <? endif; ?>
        <?
        endforeach;
        ?>
    </div>
<? endif; ?>
