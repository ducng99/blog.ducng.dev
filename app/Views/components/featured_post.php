<? if (isset($postLoaded) && $postLoaded) : ?>
	<?
	/**
	 * @var \App\Models\Post $component
	 * @var array $story
	 */
	?>
	<?= $component->_editable ?>
	<div class="bg-primary h-64 rounded-md flex flex-col">
		<div class="text-black pt-5 px-7 mb-auto">
			<h3 class="text-anchor font-bold mb-6">
				<a href="<?= base_url($story['full_slug']) ?>"><?= esc($component->title) ?></a>
			</h3>
			<div class="font-serif"><?= esc($component->summary) ?></div>
			<div class="text-anchor text-sm mt-6">
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
	 * @var \App\Models\Components\FeaturedPost $component
	 */
	?>
	<?= $component->_editable ?>
	<div class="bg-primary h-64 rounded-md flex flex-col" hx-get="<?= base_url('components/featured_post/' . $component->post) ?>" hx-trigger="revealed" hx-swap="outerHTML">
		<div class="pt-5 px-7 mb-auto">
			<h3 class="mb-6 placeholder-loading bg-gray-300 w-32">&nbsp;</h3>
			<div class="mb-1 placeholder-loading bg-gray-300 w-48">&nbsp;</div>
			<div class="mb-6 placeholder-loading bg-gray-300 w-64">&nbsp;</div>
		</div>
		<hr />
		<div class="text-xs py-3 px-7">
			<div class="placeholder-loading bg-gray-300 w-28">&nbsp;</div>
		</div>

		<style>
			.placeholder-loading {
				position: relative;
				overflow: hidden;
			}

			.placeholder-loading::after {
				content: " ";
				box-shadow: 0 0 50px 9px rgba(254, 254, 254);
				position: absolute;
				top: 0;
				left: -100%;
				height: 100%;
				animation: load 1s infinite;
			}

			@keyframes load {
				0% {
					left: -100%
				}

				100% {
					left: 150%
				}
			}
		</style>
	</div>
<? endif; ?>
