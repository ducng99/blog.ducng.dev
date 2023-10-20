<?php

use App\Libraries\Storyblok;

/**
 * This file is included by nav_dropdown.php which passthrough the component
 * @var App\Models\Components\Navbar\NavDropdown $component
 */
?>
<div class="dropdown_body">
    <?
    foreach ($component->navs as $dropdown_item) :
        switch ($dropdown_item->component):
            case "nav_link":
                /**
                 * @var App\Models\Components\Navbar\NavLink $dropdown_item
                 */
                $url = Storyblok::getURLFromLink($dropdown_item->link);
    ?>
                <?= $dropdown_item->_editable ?>
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
            ?>
                <?= $dropdown_item->_editable ?>
                <div class="nested_dropdown">
                    <? if (!empty($url)) : ?>
                        <a href="<?= esc($url, 'attr') ?>">
                        <? endif; ?>
                        <div class="dropdown_item">
                            <?= esc($dropdown_item->name) ?>
                        </div>
                        <? if (!empty($url)) : ?>
                        </a>
                    <? endif; ?>
                    <?= view('components/navbar/nav_dropdown_body', ['component' => $dropdown_item]) ?>
                </div>
    <?
                break;
            default:
                break;
        endswitch;
    endforeach;
    ?>
</div>
