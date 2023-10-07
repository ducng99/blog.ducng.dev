<? if (isset($postLoaded) && $postLoaded) : ?>
    <?
    /**
     * Component after HTMX load
     * @var \App\Models\Post $component
     * @var array $story
     */
    ?>
    <?= $component->_editable ?>
    <div class="bg-primary dark:bg-neutral-800 h-64 rounded-md flex flex-col">
        <div class="pt-5 px-7 mb-auto">
            <h3 class="text-anchor dark:text-accent font-bold mb-6">
                <a href="<?= base_url($story['full_slug']) ?>"><?= esc($story['name']) ?></a>
            </h3>
            <div class="font-serif"><?= esc($component->summary) ?></div>
            <div class="text-anchor dark:text-accent text-sm mt-6">
                <a href="<?= base_url($story['full_slug']) ?>">&gt; checkout</a>
            </div>
        </div>
        <hr />
        <div class="text-gray-500 text-xs font-serif py-3 px-7">
            <?= date("d F Y", strtotime($component->created_at)) ?>
        </div>
    </div>

<? else : ?>
    <?
    /**
     * Placeholder component before HTMX load the post
     * @var \App\Models\Components\FeaturedPost $component
     */
    ?>
    <?= $component->_editable ?>
    <div class="bg-primary dark:bg-neutral-800 h-64 rounded-md flex flex-col" hx-get="<?= base_url('components/featured_post/' . $component->post) ?>" hx-trigger="revealed" hx-swap="outerHTML">
        <div class="pt-5 px-7 mb-auto">
            <h3 class="mb-6 placeholder-loading bg-gray-300 w-32">&nbsp;</h3>
            <div class="mb-1 placeholder-loading bg-gray-300 w-48">&nbsp;</div>
            <div class="mb-6 placeholder-loading bg-gray-300 w-64">&nbsp;</div>
        </div>
        <hr />
        <div class="text-xs py-3 px-7">
            <div class="placeholder-loading bg-gray-300 w-28">&nbsp;</div>
        </div>
    </div>
<? endif; ?>
