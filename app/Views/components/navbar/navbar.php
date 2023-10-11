<?php

/**
 * @var App\Models\Components\Navbar\Navbar $component
 */
?>

<?= $component->_editable ?>
<div class="w-full">
    <div class="my_container flex items-center py-2" hx-boost="true">
        <a class="flex items-center gap-x-4 mr-auto" href="<?= base_url() ?>" title="Home">
            <? if (!empty($component->logo['filename'])) : ?>
                <img src="<?= esc($component->logo['filename'], 'attr') ?>" alt="<?= esc($component->logo['alt'], 'attr') ?>" title="<?= esc($component->logo['title'], 'attr') ?>" class="w-16 h-16" />
            <? endif; ?>
            <span class="text-3xl font-bold"><?= esc($component->name) ?></span>
        </a>
        <div class="flex gap-2">
            <?
            foreach ($component->navs as $nav_item)
            {
                switch ($nav_item->component)
                {
                    case "nav_link":
                        echo view("components/navbar/nav_link", ['component' => $nav_item]);
                        break;
                    case "nav_dropdown":
                        echo view("components/navbar/nav_dropdown", ['component' => $nav_item]);
                        break;
                    default:
                        break;
                }
            }
            ?>
        </div>
        <div>
            <?= $this->include('components/navbar/theme_toggle') ?>
        </div>
    </div>
</div>
