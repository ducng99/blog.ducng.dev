<?php

namespace App\Models\Navbar;

use App\Models\BaseModel;

class NavDropdown extends BaseModel
{
    /**
     * The name of the dropdown
     */
    public string $name = "";

    /**
     * Storyblok Link object
     */
    public array $link = [];

    /**
     * A list of links or other dropdowns
     * @var array<NavLink|NavDropdown>
     */
    public array $navs = [];
}
