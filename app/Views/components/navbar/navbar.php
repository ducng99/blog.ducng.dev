<?php

/**
 * @var App\Models\Components\Navbar\Navbar $component
 */
?>

<?= $component->_editable ?>
<div class="w-full" hx-boost="true">
    <div class="my_container max-lg:hidden flex items-center py-2">
        <a class="flex items-center gap-x-4 me-auto" href="<?= base_url() ?>" title="Home">
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

    <div class="my_container lg:hidden flex items-center justify-between py-2">
        <div class="w-16">
            <input type="checkbox" id="mobile_nav_toggle" class="hidden" />
            <label for="mobile_nav_toggle" class="pe-4 py-2 cursor-pointer checked:text-accent transition-colors text-xl">
                <i class="bi bi-list"></i>
            </label>
            <div class="mobile_nav_container" role="dialog" aria-modal="true">
                <div class="flex items-center px-4">
                    <div class="text-2xl">Menu</div>
                    <label for="mobile_nav_toggle" class="ps-4 py-2 ms-auto cursor-pointer">
                        <i class="bi bi-x-lg"></i>
                    </label>
                </div>
                <div class="mt-4">
                    <?
                    foreach ($component->navs as $nav_item)
                    {
                        switch ($nav_item->component)
                        {
                            case "nav_link":
                                echo view("components/navbar/nav_link", ['component' => $nav_item]);
                                break;
                            case "nav_dropdown":
                                echo view("components/navbar/mobile_nav_dropdown", ['component' => $nav_item]);
                                break;
                            default:
                                break;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="">
            <a href="<?= base_url() ?>" title="Home">
                <? if (!empty($component->logo['filename'])) : ?>
                    <img src="<?= esc($component->logo['filename'], 'attr') ?>" alt="<?= esc($component->logo['alt'], 'attr') ?>" title="<?= esc($component->logo['title'], 'attr') ?>" class="w-16 h-16" />
                <? endif; ?>
            </a>
        </div>
        <div class="w-16">
            <?= $this->include('components/navbar/theme_toggle') ?>
        </div>
    </div>
</div>
