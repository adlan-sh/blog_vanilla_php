<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository) {}

    public function getAll(): array
    {
        return $this->categoryRepository->getAll();
    }

    public function getAllWithLatestPosts(int $count): array
    {
        return $this->categoryRepository->getAllWithLatestPosts($count);
    }
}
