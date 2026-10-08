<?php

declare(strict_types=1);

namespace App\Core\Database;

use App\Core\Exception\DatabaseException;
use PDO;
use PDOException;
use PDOStatement;

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt;
        } catch (PDOException $e) {
            throw new DatabaseException($e->getMessage());
        }
    }

    public function fetchOne(string $sql, array $params = []): ?array
    {
        $row = $this->query($sql, $params)->fetch();

        return $row === false ? null : $row;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetchColumn(string $sql, array $params = []): mixed
    {
        return $this->query($sql, $params)->fetchColumn();
    }
}
