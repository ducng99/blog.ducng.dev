<?php

/**
 * @var array $categories
 * @var array $searchParams
 */

/**
 * @param array $categories
 * @param int $level
 * @return void
 */
function generateOptions(array $categories, array $searchParams, int $level = 0): void
{
    foreach ($categories as $category) :
?>
        <div class="px-4 hover:bg-secondary">
            <div class="flex gap-2" style="margin-left: calc(1em * <?= esc($level, 'attr') ?>)">
                <input id="checkbox_<?= esc($category['item']['uuid'], 'attr') ?>" name="categories[]" type="checkbox" value="<?= esc($category['item']['uuid'], 'attr') ?>" <?= in_array($category['item']['uuid'], $searchParams['categories']) ? 'checked' : '' ?> />
                <label for="checkbox_<?= esc($category['item']['uuid'], 'attr') ?>" class="grow cursor-pointer">
                    <?= esc($category['item']['name']) ?>
                </label>
            </div>
        </div>
<?
        if (!empty($category['children'])) :
            generateOptions($category['children'], $searchParams, $level + 1);
        endif;
    endforeach;
}
?>
<div class="mt-2">
    <input type="checkbox" class="hidden" id="categories-checkbox" />
    <label class="themable px-4 py-2 rounded-md overflow-hidden inline-flex w-full cursor-pointer" for="categories-checkbox" id="categories-label">
        Categories
        <i class="bi bi-chevron-right ms-auto transition-transform" id="categories-label-icon"></i>
    </label>
    <div class="themable rounded-md overflow-hidden transition-all max-h-0" id="categories-select">
        <div class="max-h-64 py-2 overflow-y-auto">
            <? generateOptions($categories, $searchParams) ?>
        </div>
    </div>

    <style>
        #categories-checkbox:checked~#categories-select {
            max-height: 100vh;
            margin-top: 0.5rem;
        }

        #categories-checkbox:checked~#categories-label #categories-label-icon {
            transform: rotate(90deg);
        }
    </style>
</div>
