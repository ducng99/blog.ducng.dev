<?php

use App\Libraries\Storyblok;

/**
 * @var App\Models\Components\Navbar\NavLink $component
 */

$url = Storyblok::getURLFromLink($component->link);
$active = base_url(uri_string()) == $url ? 'active' : '';
?>

<?= $component->_editable ?>
<a href="<?= esc($url, 'attr') ?>" class="nav_item <?= $active ?>">
    <?= esc($component->name) ?>
</a>
