<?php

use App\Libraries\Storyblok;

/**
 * @var \App\Models\PostsSearch $component
 * @var array $story
 * @var string $searchResults HTML string containing search results' posts
 * @var array $searchParams
 */
?>

<?= $this->extend('default') ?>

<?
echo $this->section('title');
echo esc($story['name']);
echo $this->endSection();
?>

<?= $this->section('meta_tags') ?>
<meta name="description" content="Search through the junks... You might find something useful <?= esc('¯\_(ツ)_/¯', 'attr') ?>">
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<?= $component->_editable ?>
<div class="my_container">
    <h1 class="text-8xl font-bold text-center my-24">
        <?= esc($story['name']) ?>
    </h1>

    <div>
        <form action="<?= base_url('posts') ?>" method="get" hx-get="<?= base_url('components/posts_search') ?>" hx-trigger="submit, keyup delay:550ms changed from:#q, change from:#per_page" hx-target="#search-results">
            <div class="flex flex-col md:flex-row gap-2">
                <div class="flex-grow">
                    <input type="text" name="q" id="q" class="themable text-lg w-full p-2 rounded-md" placeholder="Search..." value="<?= esc($searchParams['q'] ?? '', 'attr') ?>">
                </div>
                <div class="flex-grow-0">
                    <button type="submit" class="w-full md:w-auto h-full p-2 rounded-md bg-accent text-black font-bold"><i class="bi bi-search me-1"></i>Search</button>
                </div>
                <div class="flex-grow-0">
                    <select name="per_page" id="per_page" class="themable w-full md:w-auto h-full p-2 rounded-md">
                        <?
                        $perPageOptions = [4, 8, 12, 16];
                        foreach ($perPageOptions as $perPageOption) :
                        ?>
                            <option value="<?= esc($perPageOption, 'attr') ?>" <?= $searchParams['per_page'] == $perPageOption ? 'selected' : '' ?>><?= esc($perPageOption) ?> per page</option>
                        <? endforeach; ?>
                    </select>
                </div>
            </div>
        </form>
        <div id="search-results" class="grid grid-cols-<?= esc($component->num_columns_mobile, 'attr') ?> md:grid-cols-<?= esc($component->num_columns, 'attr') ?> gap-8 mt-8">
            <?
            if (!empty($searchResults))
            {
                echo $searchResults;
            }
            ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
