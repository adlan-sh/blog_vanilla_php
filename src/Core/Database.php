<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

class Database
{
    public function __construct(private PDO $db) {}

}