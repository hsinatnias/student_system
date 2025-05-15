<?php

namespace Tests\Repositories;

use PHPUnit\Framework\TestCase;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Database\Connection;
use PDO;

class StudentRepositoryTest extends TestCase{
    private PDO $pdo;
    protected function setUp(): void
    {
        $this->pdo = Connection::getConnection();

        $this->pdo->exec("DELETE FROM students");
        $this->pdo->exec("INSERT INTO students (id, name, email) VALUES 
        (1, 'John Doe', 'john.doe@example.com'),
        (2, 'Jane Smith', 'jane.smith@example.com')");
    }

    public function testFindByIDReturnsStudent(){

        $repository = new StudentRepository();
        $student = $repository->findById(1);

        $this->assertEquals(1, $student['id']);
        $this->assertEquals('john.doe@example.com', $student['email']);
        }


}