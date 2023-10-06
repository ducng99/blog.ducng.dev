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

$paddingsCSS = 'padding-top: ' . $component->padding_top . '; padding-bottom: ' . $component->padding_bottom . '; padding-left: ' . $component->padding_left . '; padding-right: ' . $component->padding_right . ';';
$marginsCSS = 'margin-top: ' . $component->margin_top . '; margin-bottom: ' . $component->margin_bottom . '; margin-left: ' . $component->margin_left . '; margin-right: ' . $component->margin_right . ';';

?>
<div class="w-full <?= $text_align ?>" style="<?= esc($paddingsCSS, 'attr') ?><?= esc($marginsCSS, 'attr') ?>">
    <?= Storyblok::resolver()->render($component->body) ?>
</div>
