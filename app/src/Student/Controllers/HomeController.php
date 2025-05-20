<?php

namespace Home\Solid\Student\Controllers;
use Home\Solid\Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $user = $this->authenticate();
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Hello from the StudentController API!'
        ]);
    }
}
