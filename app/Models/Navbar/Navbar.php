<?php

namespace App\Models\Navbar;

use App\Models\BaseModel;

class Navbar extends BaseModel
{
    /**
     * Storyblok asset array
     */
    public array $logo = [];
    public string $name = '';

    /**
     * A list of links or other dropdowns
     * @var array<NavLink|NavDropdown>
     */
    public array $navs = [];
}
