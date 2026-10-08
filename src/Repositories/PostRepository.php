<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database\Connection;
use App\Models\Post;

class PostRepository
{
    public function __construct(private Connection $db) {}

    public function find(int $id): ?Post
    {
        $row = $this->db->fetchOne("
        SELECT
            p.*,
            GROUP_CONCAT(c.title ORDER BY c.title SEPARATOR ',') AS categories
        FROM posts p
        LEFT JOIN post_category pc ON pc.post_id = p.id
        LEFT JOIN categories    c  ON c.id = pc.category_id
        WHERE p.id = :id
        GROUP BY p.id
    ", ['id' => $id]);

        if (!$row) {
            return null;
        }

        $row['categories'] = $row['categories']
            ? explode(',', $row['categories'])
            : [];

        $row['similar'] = array_map(fn (array $row) => new Post($row), $this->getSimilar($id, 3));

        return new Post($row);
    }

    private function getSimilar(int $postId, int $limit): array
    {
        return $this->db->fetchAll("
            SELECT DISTINCT p.id, p.title, p.image, p.description, p.views, p.published_at
            FROM posts p
            JOIN post_category pc  ON pc.post_id = p.id
            JOIN post_category pc2 ON pc2.category_id = pc.category_id
            WHERE pc2.post_id = :id
              AND p.id <> :id
            ORDER BY p.published_at DESC
            LIMIT " . $limit,
            ['id' => $postId]
        );
    }

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

    public function paginate(int $categoryId, int $page, string $sort, int $perPage = 5): array
    {
        $orderBy = match ($sort) {
            'views' => 'p.views DESC',
            default => 'p.published_at DESC',
        };
        $offset = max(0, ($page - 1) * $perPage);

        $total = (int)$this->db->fetchColumn("
            SELECT COUNT(*) FROM posts p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = :cid
        ", ['cid' => $categoryId]);

        $rows = $this->db->fetchAll("
            SELECT p.* FROM posts p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = :cid
            ORDER BY {$orderBy}
            LIMIT {$perPage} OFFSET {$offset}
        ", ['cid' => $categoryId]);

        return [
            'items' => array_map(fn(array $row) => new Post($row), $rows),
            'total' => $total,
            'pages' => (int)ceil($total / $perPage),
        ];
    }
}
