<?php
namespace Home\Solid\Auth\Repositories;

use Home\Solid\Auth\Contracts\AuthRepositoryInterface;
use Home\Solid\Database\Connection;
use PDO;

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
        $name = $data['name'] ?? '';
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role          
        ]);

        $id = (int) $this->db->lastInsertId();
        return $this->findById($id);

    }
    public function findById(int $id): array
    {
        $stmt = $this->db->prepare("SELECT id, email, role  FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new \Exception("User not found.");
        }
        return $result;
    }

}