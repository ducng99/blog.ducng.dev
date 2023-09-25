<?php

namespace App\Models;

class Post extends BaseModel
{
    public string $title = '';
    public string $created_at = '';
    public string $summary = '';

    public array $body = [];
    public array $meta_tags = [];
}
