<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    /**
     * @param string[] $segments
     */
    public function show(...$segments): ResponseInterface
    {
        $slug = implode('/', $segments);
        $category = $this->storyblok->client->getStoryBySlug('categories/' . $slug)->getBody()['story'];

        $query = http_build_query([
            'categories' => [$category['uuid']],
        ]);
        $target_url = base_url('posts?' . $query);

        if ($this->request->getHeaderLine("HX-Request") === "true")
        {
            return $this->response->setHeader('HX-Location', $target_url);
        }
        else
        {
            return redirect()->to($target_url);
        }
    }
}
