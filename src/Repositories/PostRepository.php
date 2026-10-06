<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database\Connection;
use App\Models\Post;

class PostRepository
{
    public function __construct(private Connection $db) {}

    public function getLatestByCategory(int $categoryId, int $limit): array
    {
        $rows = $this->db->fetchAll("
            SELECT p.* FROM posts p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = :cid
            ORDER BY p.published_at DESC
            LIMIT " . $limit,
            ['cid' => $categoryId]
        );

        return array_map(fn(array $row) => new Post($row), $rows);
    }
}
