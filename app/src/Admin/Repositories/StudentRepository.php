<?php

namespace Home\Solid\Admin\Repositories;

use Home\Solid\Database\Connection;
use Home\Solid\Admin\Contracts\RepositoryInterface;
use PDO;
use Exception;


class StudentRepository implements RepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function findById(int $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT u.id as user_id, 
            u.first_name,
            u.middle_name,
            u.last_name,
            u.email,
            u.role,
            u.created_at,

             s.*
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
            "SELECT u.id as user_id, u.*, s.*
             FROM users u
             JOIN students s ON u.id = s.user_id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): array
    {
        $this->db->beginTransaction();

        try {
            $stmt = $this->db->prepare("
                INSERT INTO users (email, password, role, first_name, middle_name, last_name)
                VALUES (:email, :password, 'student', :first_name, :middle_name, :last_name)
            ");
            $stmt->execute([
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':first_name' => $data['first_name'],
                ':middle_name' => $data['middle_name'] ?? null,
                ':last_name' => $data['last_name'],
            ]);
            $userId = (int) $this->db->lastInsertId();

            // 2. Compose enrollment number
            $enrollmentNumber = $userId . $data['year'];

            // 3. Insert into students
            $stmt = $this->db->prepare("
                INSERT INTO students (user_id, enrollment_number, year, date_of_birth, gender, course_id, department_id, status)
                VALUES (:user_id, :enrollment_number, :year, :dob, :gender, :course_id, :department_id, 'pending')
            ");
            $stmt->execute([
                ':user_id' => $userId,
                ':enrollment_number' => $enrollmentNumber,
                ':year' => $data['year'],
                ':dob' => $data['date_of_birth'],
                ':gender' => $data['gender'],
                ':course_id' => $data['course_id'],
                ':department_id' => $data['department_id'],
            ]);



            $this->db->commit();
            return $this->findById($userId);
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
            $this->db->prepare("UPDATE users 
            SET 
            first_name = :fname,
            middle_name = :mname,
            last_name = :lname,
            role= 'student',
            password =:password,
             email = :email WHERE id = :id")
                ->execute([
                    ':fname' => $data['first_name'],
                    ':mname' => $data['middle_name'] ?? '',
                    ':lname' => $data['last_name'],
                    ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    ':email' => $data['email'],
                    ':id' => $userId
                ]);

            // Update student table
            $this->db->prepare(
                "UPDATE students SET enrollment_number = :enrollment_number, course_id = :course_id,
                 year = :year, department_id = :department_id, date_of_birth = :dob, gender = :gender
                 WHERE user_id = :id"
            )->execute([
                        ':enrollment_number' => $data['enrollment_number'],
                        ':course_id' => $data['course_id'] ?? null,
                        ':year' => $data['year'] ?? null,
                        ':department_id' => $data['department_id'] ?? null,
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

    public function updateStatus(int $id, string $status): bool
    {
        $student = $this->findById($id);
        $userID = $student['user_id'];
        $this->db->beginTransaction();
        try {

            $stmt = $this->db->prepare("UPDATE students SET status = :status WHERE user_id= :user_id");
            $stmt->execute([':status' => $status, ':user_id' => $userID]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
