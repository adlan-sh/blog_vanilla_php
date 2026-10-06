<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    public function __construct(private PostRepository $postRepository) {}

    public function getLatestByCategory(int $categoryId, int $limit): array
    {
        return $this->postRepository->getLatestByCategory($categoryId, $limit);
    }
}
