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

    public function createUser($name, $email, $hashedPassword, $role){
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, :created_at)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            
        ]);

        $id = (int) $this->db->lastInsertId();
        return $this->findById($id);

    }

}