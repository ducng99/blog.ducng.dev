<?php

/**
 * @var App\Models\Navbar\NavLink $component
 */

use App\Libraries\Storyblok;

$url = Storyblok::getURLFromLink($component->link);
?>

<?= $component->_editable ?>
<a href="<?= esc($url, 'attr') ?>" class="nav_item">
    <?= esc($component->name) ?>
</a>
