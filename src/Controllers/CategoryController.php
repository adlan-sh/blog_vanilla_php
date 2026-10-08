<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\MVC\View;
use App\Services\CategoryService;
use App\Services\PostService;

class CategoryController
{
    public function __construct(
        private CategoryService $categoryService,
        private PostService $postService,
    ) {}

    public function show(int $id): string
    {
        $category = $this->categoryService->getById($id);

        $sort = $_GET['sort'] ?? 'date';
        $page = max(1, (int)($_GET['page'] ?? 1));

        $posts = $this->postService->getPaginatedByCategory($id, $page, $sort);

        return View::render('category.tpl', [
            'category' => $category,
            'posts' => $posts['items'],
            'totalPages' => $posts['pages'],
            'currentPage'=> $page,
            'sort' => $sort,
        ]);
    }
}