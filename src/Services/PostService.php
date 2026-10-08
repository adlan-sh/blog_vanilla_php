<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostService
{
    public function __construct(private PostRepository $postRepository) {}

    public function getLatestByCategory(int $categoryId, int $limit): array
    {
        return $this->postRepository->getLatestByCategory($categoryId, $limit);
    }

    public function getPaginatedByCategory(int $categoryId, int $page, string $sort): array
    {
        return $this->postRepository->paginate($categoryId, $page, $sort);
    }

    public function getById(int $id): Post
    {
        $post = $this->postRepository->find($id);

        if ($post === null) {
            throw new NotFoundException();
        }

        return $post;
    }
}
