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

<?php
echo $this->section('meta_tags');

foreach ($component->meta_tags as $meta_tag) :
?>
    <meta name="<?= esc($meta_tag->name, 'attr') ?>" content="<?= esc($meta_tag->content, 'attr') ?>">
<?php
endforeach;

echo $this->endSection();
?>

<?= $this->section('main') ?>
<?= $component->_editable ?>
<div class="my_container">
    <?php
    foreach ($component->body as $nestedComponent)
    {
        $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        echo view($viewName, ['component' => $nestedComponent]);
    }
    ?>
</div>
<?= $this->endSection() ?>
