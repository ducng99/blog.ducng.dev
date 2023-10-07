<?php

use App\Libraries\Storyblok;

/** @var App\Models\Components\BootstrapIcon $component */

$fontSizeCSS = !empty($component->size) ? "font-size:{$component->size}" : '';
$colorCSS = !empty($component->colour) ? "color:{$component->colour}" : '';

$url = Storyblok::getURLFromLink($component->link);

$marginsCSS = 'margin: ' . $component->margin_top . ' ' . $component->margin_right . ' ' . $component->margin_bottom . ' ' . $component->margin_left;
?>

<?= $component->_editable ?>
<? if (!empty($url)) : ?>
    <a class="not-prose" href="<?= esc($url, 'attr') ?>" <? if (!empty($component->link['target'])) : ?> target="<?= esc($component->link['target'], 'attr') ?>" <? endif; ?>>
    <? endif; ?>
    <span style="<?= esc($marginsCSS, 'attr') ?>;<?= esc($colorCSS, 'attr') ?>;<?= esc($fontSizeCSS, 'attr') ?>">
        <i class="bi bi-<?= esc($component->icon, 'attr') ?><? if (!empty($url)) : ?> hover:text-accent<? endif; ?>"></i>
    </span>
    <? if (!empty($url)) : ?>
    </a>
<? endif; ?>
