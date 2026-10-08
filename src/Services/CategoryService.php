<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository) {}

    public function getAll(): array
    {
        return $this->categoryRepository->getAll();
    }

    public function getById(int $id): Category
    {
        $category = $this->categoryRepository->find($id);

        if ($category === null) {
            throw new NotFoundException();
        }

        return $category;
    }
}
