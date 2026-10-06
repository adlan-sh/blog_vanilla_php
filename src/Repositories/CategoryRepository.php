<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database\Connection;
use App\Models\Category;

class CategoryRepository
{
    public function __construct(private Connection $db) {}

    public function find(int $id): ?Category
    {
        $row = $this->db->fetchOne(
            "SELECT * FROM categories WHERE id = :id",
            ['id' => $id]
        );

        return $row ? new Category($row) : null;
    }

    public function getAll(): array
    {
        $rows = $this->db->fetchAll("SELECT * FROM categories ORDER BY title");

        return array_map(fn(array $row) => new Category($row), $rows);
    }
}
