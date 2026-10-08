<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\MVC\View;
use App\Services\PostService;

class PostController
{
    public function __construct(private PostService $postService) {}

    public function show(int $id): string
    {
        $post = $this->postService->getById($id);

        #$this->postService->incrementViews($id);
        #$post['views']++;

        return View::render('post.tpl', [
            'post' => $post,
            #'similar' => $this->postService->similar($id, 3),
        ]);
    }
}