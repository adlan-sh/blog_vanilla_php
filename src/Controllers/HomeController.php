<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\PostService;

class HomeController
{
    public function __construct(
        private CategoryService $categoryService,
        private PostService $postService
    ) {}

    public function index(): string
    {
        $categories = $this->categoryService->getAll();

        $data = array_map(function (Category $category) {
            return [
                'category' => $category,
                'posts' => $this->postService->getLatestByCategory($category->id, 3),
            ];
        }, $categories);

        return View::render('home.tpl', [
            'data' => $data,
        ]);
    }
}
