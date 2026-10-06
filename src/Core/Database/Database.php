<?php

declare(strict_types=1);

namespace App\Core\Database;

use App\Core\Exception\DatabaseException;
use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(array $config): PDO
    {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['name']};charset=utf8mb4";

                self::$pdo = new PDO($dsn, $config['user'], $config['password']);
            } catch (PDOException $e) {
                throw new DatabaseException("Couldn't connect to the database: " . $e->getMessage());
            }

        }

        return self::$pdo;
    }

    public static function getConnection(): PDO
    {
        return self::$pdo;
    }
}
