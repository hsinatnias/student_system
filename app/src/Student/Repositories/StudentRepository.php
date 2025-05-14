<?php

namespace Home\Solid\Student\Repositories;
use Home\Solid\Database\Connection;
use PDO;


class StudentRepository{

    private PDO $db;

    public function __construct()
    {
        $this->db = (Connection::getConnection());
    }
    public function findById(int $id): array{

        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$student) {
            throw new \Exception("Student not found");
        }
        return $student;
        // For demonstration purposes, returning a static array
       
        // return [
        //     'id'=> $id,
        //     'name'=> 'John Doe',
        //     'email'=> 'john@example.com'
        // ];
    }
}