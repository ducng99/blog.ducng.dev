<?php

namespace App\Models;

use App\Models\Components\MetaTag;

class Page extends BaseModel
{
    /** @var ?array<BaseModel> */
    public array $body = [];

    /** @var ?array<MetaTag> */
    public array $meta_tags = [];
}
