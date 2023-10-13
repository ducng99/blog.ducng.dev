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
        <option class="px-4" value="<?= esc($category['item']['uuid'], 'attr') ?>" <?= in_array($category['item']['uuid'], $searchParams['categories']) ? 'selected' : '' ?>>
            <?= str_repeat('--', $level) . esc($category['item']['name']) ?>
        </option>
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
    <div class="rounded-md overflow-hidden transition-all max-h-0" id="categories-select">
        <select class="themable py-2 w-full h-64" multiple="multiple" name="categories[]">
            <? generateOptions($categories, $searchParams) ?>
        </select>
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
