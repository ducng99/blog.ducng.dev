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
    <a href="<?= esc($url, 'attr') ?>">
        <div class="nav_item <?= $active ?> dropdown_btn">
            <?= esc($component->name) ?>
        </div>
    </a>
    <?= $this->include('components/navbar/nav_dropdown_body'); ?>
</div>
