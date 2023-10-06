<?php

use App\Libraries\Storyblok;

/**
 * @var App\Models\Navbar\NavLink $component
 */

$url = Storyblok::getURLFromLink($component->link);
?>

<?= $component->_editable ?>
<a href="<?= esc($url, 'attr') ?>" class="nav_item">
    <?= esc($component->name) ?>
</a>
