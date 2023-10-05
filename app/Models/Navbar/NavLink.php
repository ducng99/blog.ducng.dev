<?php

namespace App\Models\Navbar;

use App\Models\BaseModel;
use App\Libraries\Storyblok;

class NavLink extends BaseModel
{
    public string $name = '';

    /**
     * Storyblok Link object
     */
    public array $link = [];
}
