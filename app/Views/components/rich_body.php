<?php

use App\Libraries\Storyblok;

/** @var \App\Models\Components\RichBody $component */

?>

<?= $component->_editable ?>
<?
$text_align = match ($component->text_align)
{
    'center' => 'text-center',
    'right' => 'text-right',
    default => 'text-left',
};

$paddingsCSS = 'padding: ' . $component->padding_top . ' ' . $component->padding_right . ' ' . $component->padding_bottom . ' ' . $component->padding_left . ';';
$marginsCSS = 'margin: ' . $component->margin_top . ' ' . $component->margin_right . ' ' . $component->margin_bottom . ' ' . $component->margin_left . ';';

?>
<div class="w-full <?= $text_align ?>" style="<?= esc($paddingsCSS, 'attr') ?><?= esc($marginsCSS, 'attr') ?>">
    <?= Storyblok::resolver()->render($component->body) ?>
</div>
