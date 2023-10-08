<?php

/** @var App\Models\Components\ImagesCarousel $component */
?>

<?= $component->_editable ?>
<div class="w-full carousel">
    <? foreach ($component->images as $image) : ?>
        <div class="carousel-cell">
            <img src="<?= esc($image['filename'], 'attr') ?>" alt="<?= esc($image['alt'], 'attr') ?>" title="<?= esc($image['title']) ?>">
        </div>
    <? endforeach; ?>
</div>
<script>
    new Flickity('.carousel', {
        imagesLoaded: true,
    });
</script>
