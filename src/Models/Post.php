<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

class Post
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $content,
        public int $views,
        public string $image,
        public DateTimeImmutable $published_at,
        public array $categories,
    ) {}
}
