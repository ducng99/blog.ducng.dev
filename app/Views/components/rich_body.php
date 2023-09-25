<?php

/** @var \App\Models\Components\RichBody $component */

use App\Libraries\Storyblok;

?>

<?= Storyblok::resolver()->render($component->body) ?>
