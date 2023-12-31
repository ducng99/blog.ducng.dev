<?php

use App\Libraries\Storyblok;

/** @var \App\Models\Components\Grid $component */
?>

<?= $component->_editable ?>
<div class="grid grid-cols-<?= esc($component->num_columns_mobile, 'attr') ?> md:grid-cols-<?= esc($component->num_columns, 'attr') ?> gap-8">
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
