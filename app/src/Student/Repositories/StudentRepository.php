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
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new \Exception("Student not found.");
        }
        return $result;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): array
    {
        $stmt = $this->db->prepare("INSERT INTO students (name, email) VALUES (:name, :email)");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email']
        ]);

        $id = (int) $this->db->lastInsertId();
        return $this->findById($id);
    }

    public function update(int $id, array $data): array
    {
        $stmt = $this->db->prepare("UPDATE students SET name = :name, email = :email WHERE id = :id");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':id' => $id
        ]);

        return $this->findById($id);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
