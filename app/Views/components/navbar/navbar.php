<?php

/**
 * @var App\Models\Navbar\Navbar $component
 */
?>

<?= $component->_editable ?>
<div class="w-screen">
    <div class="lg:container lg:mx-auto lg:max-w-5xl px-4 lg:px-0 flex items-center py-2">
        <a class="flex items-center gap-x-4 mr-auto" href="<?= base_url() ?>" title="Home">
            <? if (!empty($component->logo['filename'])) : ?>
                <img src="<?= esc($component->logo['filename'], 'attr') ?>" alt="<?= esc($component->logo['alt'], 'attr') ?>" title="<?= esc($component->logo['title'], 'attr') ?>" class="w-16 h-16" />
                <span class="text-4xl font-bold"><?= esc($component->name) ?></span>
            <? endif; ?>
        </a>
        <div class="flex gap-2">
            <?
            foreach ($component->navs as $nav_item) :
                switch ($nav_item->component):
                    case "nav_link":
                        echo view("components/navbar/nav_link", ['component' => $nav_item]);
                        break;
                    case "nav_dropdown":
                        echo view("components/navbar/nav_dropdown", ['component' => $nav_item]);
                        break;
                    default:
                        break;
                endswitch;
            endforeach;
            ?>
        </div>
    </div>
</div>