<?php

namespace Home\Solid\Student\Repositories;

use Home\Solid\Database\Connection;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use PDO;
use Exception;


class StudentRepository implements StudentRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT u.id as user_id, u.name, u.email, s.*
             FROM users u
             JOIN students s ON u.id = s.user_id
             WHERE s.id = :id"
        );
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception("Student not found.");
        }
        return $result;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT u.id as user_id, u.name, u.email, s.*
             FROM users u
             JOIN students s ON u.id = s.user_id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): array
    {
        $this->db->beginTransaction();

        try {
            // Insert into users table
            $userStmt = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 'student')");
            $userStmt->execute([
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':password' => $data['password'] ?? password_hash('password123', PASSWORD_DEFAULT) // default/fake password if not provided
            ]);

            $userId = (int) $this->db->lastInsertId();

            // Insert into students table
            $studentStmt = $this->db->prepare(
                "INSERT INTO students (user_id, enrollment_number, course, year, department, date_of_birth, gender)
                 VALUES (:user_id, :enrollment_number, :course, :year, :department, :dob, :gender)"
            );

            $studentStmt->execute([
                ':user_id' => $userId,
                ':enrollment_number' => $data['enrollment_number'],
                ':course' => $data['course'] ?? null,
                ':year' => $data['year'] ?? null,
                ':department' => $data['department'] ?? null,
                ':dob' => $data['date_of_birth'] ?? null,
                ':gender' => $data['gender'] ?? null
            ]);

            $studentId = (int) $this->db->lastInsertId();
            $this->db->commit();
            return $this->findById($studentId);

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $data): array
    {
        // First get the student to get user_id
        $student = $this->findById($id);
        $userId = $student['user_id'];

        $this->db->beginTransaction();
        try {
            // Update user table
            $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id")
                ->execute([
                    ':name' => $data['name'],
                    ':email' => $data['email'],
                    ':id' => $userId
                ]);

            // Update student table
            $this->db->prepare(
                "UPDATE students SET enrollment_number = :enrollment_number, course = :course,
                 year = :year, department = :department, date_of_birth = :dob, gender = :gender
                 WHERE id = :id"
            )->execute([
                ':enrollment_number' => $data['enrollment_number'],
                ':course' => $data['course'] ?? null,
                ':year' => $data['year'] ?? null,
                ':department' => $data['department'] ?? null,
                ':dob' => $data['date_of_birth'] ?? null,
                ':gender' => $data['gender'] ?? null,
                ':id' => $id
            ]);

            $this->db->commit();
            return $this->findById($id);

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        $student = $this->findById($id);
        $userId = $student['user_id'];

        // Delete user (will cascade to students table due to foreign key)
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $userId]);
    }
}
