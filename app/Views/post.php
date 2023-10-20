<?php

use App\Libraries\Storyblok;

/**
 * @var \App\Models\Post $component
 * @var array $story
 */
?>

<?= $this->extend('default') ?>

<?
echo $this->section('title');
echo esc($story['name']);
echo $this->endSection();
?>

<?= $this->section('meta_tags') ?>
<meta name="description" content="<?= esc($component->summary, 'attr') ?>">
<? foreach ($component->meta_tags as $meta_tag) : ?>
    <meta name="<?= esc($meta_tag->name, 'attr') ?>" content="<?= esc($meta_tag->content, 'attr') ?>">
<?
endforeach;

echo $this->endSection();
?>

<?= $this->section('main') ?>
<?= $component->_editable ?>
<div class="my_container">
    <h1 class="text-4xl lg:text-7xl font-bold text-center my-12 lg:my-24 break-words">
        <?= esc($story['name']) ?>
    </h1>

    <? if ($component->show_created_at) : ?>
        <div class="mb-4">
            &lt;posted date=&quot;<?= date('Y-m-d', strtotime($component->created_at)) ?>&quot; time=&quot;<?= date('H:i', strtotime($component->created_at)) ?>&quot; /&gt;
        </div>
    <? endif; ?>

    <div class="themable rounded-md font-serif text-base p-4">
        <?php
        foreach ($component->body as $nestedComponent)
        {
            $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
            echo view($viewName, ['component' => $nestedComponent]);
        }
        ?>
    </div>
</div>
<?= $this->endSection() ?>
