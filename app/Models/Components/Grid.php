<?php

namespace App\Models\Components;

use App\Models\BaseModel;

class Grid extends BaseModel
{
    public int $num_columns = 1;
    /** @var array<BaseModel> */
    public array $body = [];

    public bool $wrap_item = true;
}
