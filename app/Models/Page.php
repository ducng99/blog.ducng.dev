<?php

namespace App\Models;

class Page extends BaseModel
{
    /** @var array<BaseModel> */
    public array $body = [];

    /** @var array<Components\MetaTag> */
    public array $meta_tags = [];
}
