<?php

namespace Home\Solid\Student\Controllers;

class DepartmentController
{
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode([
            ['id' => 1, 'name' => 'Engineering'],
            ['id' => 2, 'name' => 'Humanities'],
            ['id' => 3, 'name' => 'Sciences']
        ]);
    }
}
