<?php

/** @var \App\Models\Page $component */

use App\Libraries\Storyblok;

?>

<?= $this->extend('default') ?>

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
<div class="lg:container lg:mx-auto lg:max-w-5xl px-4 lg:px-0">
    <?php
    foreach ($component->body as $nestedComponent)
    {
        $viewName = Storyblok::getViewFromComponent($nestedComponent->component);
        echo view($viewName, ['component' => $nestedComponent]);
    }
    ?>
</div>
<?= $this->endSection() ?>
