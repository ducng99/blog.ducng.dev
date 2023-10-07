<?php

namespace App\Models\Components;

use App\Models\BaseModel;

class BootstrapIcon extends BaseModel
{
    public string $icon = '';
    public string $size = '';
    public string $colour = '';

    /**
     * Storyblok link object
     */
    public array $link = [];

    public string $margin_top = '0';
    public string $margin_bottom = '0';
    public string $margin_left = '0';
    public string $margin_right = '0';
}
