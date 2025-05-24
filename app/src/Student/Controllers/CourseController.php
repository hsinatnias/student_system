<?php

namespace Home\Solid\Student\Controllers;

class CourseController
{
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode([
            ['id' => 1, 'name' => 'Computer Science'],
            ['id' => 2, 'name' => 'Mathematics'],
            ['id' => 3, 'name' => 'Physics']
        ]);
    }
}
