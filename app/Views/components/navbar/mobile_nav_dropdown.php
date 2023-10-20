<?php

use App\Libraries\Storyblok;

/**
 * @var App\Models\Components\Navbar\NavDropdown $component
 */

$url = Storyblok::getURLFromLink($component->link);
$active = base_url(uri_string()) == $url ? 'active' : '';
?>

<?= $component->_editable ?>
<div class="mobile_nav_dropdown">
    <input type="checkbox" id="mobile_nav_dropdown_<?= esc($component->_uid, 'attr') ?>" class="hidden dropdown_toggle" />
    <label for="mobile_nav_dropdown_<?= esc($component->_uid, 'attr') ?>" class="flex items-center justify-between cursor-pointer h-full">
        <? if (!empty($url)) : ?>
            <a href="<?= esc($url, 'attr') ?>">
            <? endif; ?>
            <div class="mobile_nav_item <?= $active ?>">
                <?= esc($component->name) ?>
            </div>
            <? if (!empty($url)) : ?>
            </a>
        <? endif; ?>
        <i class="bi bi-chevron-right me-4 dropdown_icon"></i>
    </label>
    <div class="dropdown_body">
        <?
        foreach ($component->navs as $dropdown_item) :
            switch ($dropdown_item->component):
                case "nav_link":
                    /**
                     * @var App\Models\Components\Navbar\NavLink $dropdown_item
                     */
                    $url = Storyblok::getURLFromLink($dropdown_item->link);
                    echo $dropdown_item->_editable;
        ?>
                    <a href="<?= esc($url, 'attr') ?>">
                        <div class="dropdown_item">
                            <?= esc($dropdown_item->name) ?>
                        </div>
                    </a>
        <?
                    break;
                case "nav_dropdown":
                    /**
                     * @var App\Models\Components\Navbar\NavDropdown $dropdown_item
                     */
                    $url = Storyblok::getURLFromLink($dropdown_item->link);
                    echo $dropdown_item->_editable;
                    echo view('components/navbar/mobile_nav_dropdown', ['component' => $dropdown_item]);
                    break;
                default:
                    break;
            endswitch;
        endforeach;
        ?>
    </div>
</div>
