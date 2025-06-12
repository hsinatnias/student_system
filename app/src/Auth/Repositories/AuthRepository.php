<?php
namespace Home\Solid\Auth\Repositories;

use PDO;
use Exception;
use Home\Solid\Database\Connection;
use Home\Solid\Auth\Contracts\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface{
    private PDO $db;
    public function __construct(){
        $this->db = Connection::getConnection();
    }

    public function findByEmail(string $email): ?array{
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function createUser($data): ?array{
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
    public function findById(int $id): array
    {
        $stmt = $this->db->prepare("SELECT id, first_name, last_name, email, role  FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new \Exception("User not found.");
        }
        return $result;
    }

}