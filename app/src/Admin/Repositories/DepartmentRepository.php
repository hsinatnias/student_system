<?php

namespace Home\Solid\Admin\Repositories;

use PDO;
use Exception;
use Home\Solid\Database\Connection;
use Home\Solid\Admin\Contracts\RepositoryInterface;

class DepartmentRepository implements RepositoryInterface{

    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): array
    {

        $stmt = $this->db->prepare(
            "SELECT * FROM departments WHERE id = :id"
        );
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception("Department not found.");
        }
        return $result;

    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM departments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): array
    {
        $this->db->beginTransaction();

        try {
            $stmt = $this->db->prepare("INSERT INTO departments (name) VALUES (:name)");
            $stmt->execute([
                ':name' => $data['name'],
            ]);
            $department_id = (int) $this->db->lastInsertId();

            $this->db->commit();
            return $this->findById( $department_id);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $data): array
    {
        return [];
    }

    public function delete(int $id): bool
    {
        

        // Delete user (will cascade to students table due to foreign key)
        $stmt = $this->db->prepare("DELETE FROM departments WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

}