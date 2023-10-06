<?php

use App\Libraries\Storyblok;

/**
 * @var App\Models\Navbar\NavDropdown $component
 */

$url = Storyblok::getURLFromLink($component->link);
?>

<?= $component->_editable ?>
<div class="nav_dropdown">
    <a href="<?= esc($url, 'attr') ?>">
        <div class="nav_item dropdown_btn">
            <?= esc($component->name) ?>
        </div>
    </a>
    <?= $this->include('components/navbar/nav_dropdown_body'); ?>
</div>
