<?php

namespace App\Models\Components;

use App\Models\BaseModel;

class RichBody extends BaseModel
{
	public array $body = [];
	public string $text_align = 'left';

	public string $padding_top = '0';
	public string $padding_bottom = '0';
	public string $padding_left = '0';
	public string $padding_right = '0';

	public string $margin_top = '0';
	public string $margin_bottom = '0';
	public string $margin_left = '0';
	public string $margin_right = '0';
}
