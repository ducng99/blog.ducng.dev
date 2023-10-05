<?php

/**
 * This file is included by nav_dropdown.php which passthrough the component
 * @var App\Models\Navbar\NavDropdown $component
 */

use App\Libraries\Storyblok;
?>
<div class="dropdown_body">
    <?
    foreach ($component->navs as $dropdown_item) :
        switch ($dropdown_item->component):
            case "nav_link":
                /**
                 * @var App\Models\Navbar\NavLink $dropdown_item
                 */
                $url = Storyblok::getURLFromLink($dropdown_item->link);
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
                 * @var App\Models\Navbar\NavDropdown $dropdown_item
                 */
                $url = Storyblok::getURLFromLink($dropdown_item->link);
            ?>
                <div class="nested_dropdown">
                    <a href="<?= esc($url, 'attr') ?>">
                        <div class="dropdown_item">
                            <?= esc($dropdown_item->name) ?>
                        </div>
                    </a>
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