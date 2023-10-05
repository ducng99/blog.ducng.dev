<?php

/**
 * @var App\Models\Navbar\NavDropdown $component
 */

use App\Libraries\Storyblok;

$url = Storyblok::getURLFromLink($component->link);
?>

<?= $component->_editable ?>
<div class="nav_item nav_dropdown">
    <a href="<?= esc($url, 'attr') ?>" class="dropdown_btn">
        <?= esc($component->name) ?>
    </a>
    <?= $this->include('components/navbar/nav_dropdown_body'); ?>
</div>
