<?php

declare(strict_types=1);

namespace App\Models;

class Category
{
    public int $id;
    public string $title;
    public string $description;

    private array $relations = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
    }

    public function setRelation(string $key, array $value): void
    {
        $this->relations[$key] = $value;
    }
}
