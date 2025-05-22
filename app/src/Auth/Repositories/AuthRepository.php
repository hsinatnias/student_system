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

}