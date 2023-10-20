<?php

use App\Libraries\Storyblok;

/**
 * @var App\Models\Components\Navbar\NavDropdown $component
 */

$url = Storyblok::getURLFromLink($component->link);
$active = base_url(uri_string()) == $url ? 'active' : '';
?>

<?= $component->_editable ?>
<div class="nav_dropdown">
    <? if (!empty($url)) : ?>
        <a href="<?= esc($url, 'attr') ?>">
        <? endif; ?>
        <div class="nav_item <?= $active ?> dropdown_btn">
            <?= esc($component->name) ?>
        </div>
        <? if (!empty($url)) : ?>
        </a>
    <? endif; ?>
    <?= $this->include('components/navbar/nav_dropdown_body'); ?>
</div>
