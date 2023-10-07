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
<div class="lg:container lg:mx-auto lg:max-w-5xl px-4 lg:px-0">
    <h1 class="text-8xl text-center my-24">
        <?= esc($story['name']) ?>
    </h1>

    <div class="mt-0">
        &lt;posted date=&quot;<?= date('Y-m-d', strtotime($component->created_at)) ?>&quot; time=&quot;<?= date('H:i', strtotime($component->created_at)) ?>&quot; /&gt;
    </div>

    <div class="rounded-md bg-primary dark:bg-neutral-800 text-black dark:text-white font-serif text-base p-4">
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
