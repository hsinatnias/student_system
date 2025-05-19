<?php

namespace Home\Solid\Student\Controllers;

class HomeController
{
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Hello from the StudentController API!'
        ]);
    }
}
