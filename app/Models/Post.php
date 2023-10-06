<?php

namespace App\Models;

class Post extends BaseModel
{
    public string $created_at = '';
    public string $summary = '';

    /** @var array<BaseModel> */
    public array $body = [];

    /** @var array<Components\MetaTag> */
    public array $meta_tags = [];
}
