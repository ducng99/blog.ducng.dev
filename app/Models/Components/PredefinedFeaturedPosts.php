<?php

namespace App\Models\Components;

use App\Models\BaseModel;
use App\Libraries\Storyblok;

class PredefinedFeaturedPosts extends BaseModel
{
	public string $sort_by = 'created_at:desc';
	public int $per_page = 4;
	public string $with_tag = '';

	/**
	 * @var \App\Models\Components\FeaturedPost[]
	 */
	public array $posts = [];

	public function __construct(array $data = [])
	{
		parent::__construct($data);

		$storyblok = new Storyblok();
		$stories = $storyblok->client->getStories([
			'starts_with' => 'posts/',
			'sort_by' => $this->sort_by,
			'per_page' => $this->per_page,
			'with_tag' => $this->with_tag,
			'excluding_fields' => 'id,name,slug,full_slug,created_at,published_at,first_published_at,sort_by_date,position,tag_list,is_startpage,parent_id,group_id,alternates,translated_slugs,release_id,lang,content',
		])->getBody()['stories'];

		foreach ($stories as $story)
		{
			$featuredPost = new FeaturedPost([]);
			$featuredPost->post = $story['uuid'];
			$this->posts[] = $featuredPost;
		}
	}
}
