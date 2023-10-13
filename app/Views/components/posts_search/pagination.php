<?php

/**
 * @var array $searchParams
 * @var int $totalPages
 */

$prevUrl = '';
$htmxPrevUrl = '';
$nextUrl = '';
$htmxNextUrl = '';

if ($searchParams['page'] > 1)
{
    $tmpSearchParams = $searchParams;
    $tmpSearchParams['page']--;
    $urlParams = http_build_query($tmpSearchParams);

    $prevUrl = base_url('posts?' . $urlParams);
    $htmxPrevUrl = base_url('components/posts_search?' . $urlParams);
}

if ($searchParams['page'] < $totalPages)
{
    $tmpSearchParams = $searchParams;
    $tmpSearchParams['page']++;
    $urlParams = http_build_query($tmpSearchParams);

    $nextUrl = base_url('posts?' . $urlParams);
    $htmxNextUrl = base_url('components/posts_search?' . $urlParams);
}
?>

<div class="flex justify-center col-span-full" hx-indicator="#search-loading" hx-target="#search-results" hx-trigger="click">
    <div class="flex gap-2">
        <div class="<?= empty($prevUrl) ? 'opacity-30 cursor-not-allowed' : '' ?>">
            <a href="<?= esc($prevUrl, 'attr') ?>" class="themable p-2 rounded-md font-bold flex items-center <?= empty($prevUrl) ? 'pointer-events-none' : '' ?>" hx-get="<?= esc($htmxPrevUrl, 'attr') ?>"><i class="bi bi-chevron-left"></i>Prev</a>
        </div>
        <div class="<?= empty($nextUrl) ? 'opacity-30 cursor-not-allowed' : '' ?>">
            <a href="<?= esc($nextUrl, 'attr') ?>" class="themable p-2 rounded-md font-bold flex items-center <?= empty($nextUrl) ? 'pointer-events-none' : '' ?>" hx-get="<?= esc($htmxNextUrl, 'attr') ?>">Next<i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
</div>
