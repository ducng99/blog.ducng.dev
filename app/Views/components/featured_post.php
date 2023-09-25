<?php

?>
<? if (isset($postLoaded) && $postLoaded) : ?>
	<?
	/**
	 * @var \App\Models\Post $component
	 */
	?>
	<div>
		<h3><?= $component->title ?></h3>
		<div><?= $component->summary ?></div>
	</div>

<? else : ?>
	<?
	/**
	 * @var \App\Models\Components\FeaturedPost $component
	 */
	?>
	<?= $component->_editable ?>
	<div hx-get="<?= base_url('components/featured_post/' . $component->post) ?>" hx-trigger="load">
		Title
	</div>
<? endif; ?>
