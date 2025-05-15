<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use Home\Solid\Student\Models\Student;

class StudentTest extends TestCase{

    public function testConstructorAssignPropertiesCorrectly(){
        $student = new Student(1, 'john', 'john@test.com');
        
        $this->assertSame(1, $student->id);
        $this->assertSame('john', $student->name);
        $this->assertSame('john@test.com', $student->email);

    }

    public function testFromArrayCreatesCorrectStudentInstance(){
        $data =[
            'id'=>2,
            'name'=> 'anish',
            'email'=>'anish@test.com'
        ];

        $student = Student::fromArray($data);

        $this->assertInstanceOf(Student::class, $student);
        $this->assertSame(2, $student->id);
        $this->assertSame('anish', $student->name);
        $this->assertSame('anish@test.com', $student->email);
        $this->assertStringContainsStringIgnoringCase('anish', $student->name);
    }
}