<?php

namespace Tests\Repositories;

use PHPUnit\Framework\TestCase;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Database\Connection;
use PDO;

class StudentRepositoryTest extends TestCase{
    private PDO $pdo;
    private StudentRepository $repo;
    protected function setUp(): void
    {
        $this->pdo = Connection::getConnection();
        $this->repo = new StudentRepository();
        $this->pdo->exec("DELETE FROM students");       
    }

    public function testCreateStudent(){

        $data = ['name' => 'James Keen', 'email' => 'james@test.com'];
        $student = $this->repo->create($data);

        
        $this->assertEquals('James Keen', $student['name']);
        $this->assertEquals('james@test.com', $student['email']);
        }
        public function testUpdateStudent(){
            $data = ['name' => 'Ivy', 'email' => 'ivy@test.com'];
            $student = $this->repo->create($data);

            $updated = $this->repo->update($student['id'], [
                'name' => 'John',
                'email' => 'john@test.com'
            ]);

            $this->assertEquals('John', $updated['name']);
            $this->assertEquals('john@test.com', $updated['email']);
        }

        public function testDeleteStudent(){
            $data = ['name' => 'Nancy', 'email' => 'nancy@test.com'];
            $created = $this->repo->create($data);

            $deleted = $this->repo->delete($created['id']);
            $this->assertTrue($deleted);
        }


}