<?php

declare(strict_types=1);

namespace App\Models;

class Category
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
    ) {}
}
