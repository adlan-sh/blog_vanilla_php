<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

class Post
{
    public int $id;
    public string $title;
    public string $description;
    public string $content;
    public int $views;
    public string $image;
    public DateTimeImmutable $published_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->content = $data['content'];
        $this->views = $data['views'];
        $this->image = $data['image'];
        $this->published_at = new DateTimeImmutable($data['published_at']);
    }
}
