<?php

namespace Home\Solid\Student\Repositories;
use Home\Solid\Database\Connection;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use PDO;


class StudentRepository implements StudentRepositoryInterface
{

    private PDO $db;

    public function __construct()
    {
        $this->db = (Connection::getConnection());
    }
    public function findById(int $id): array
    {

        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}