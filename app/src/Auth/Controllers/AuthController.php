<?php

namespace Home\Solid\Auth\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController{
    private string $secret;

    public function __construct()
    {
        $this->secret = $_ENV['JWT_SECRET'] ?? 'secret123';
        
    }

    public function login(){
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if($email === 'admin@test.com' && $password === 'admin123'){
            $payload = [
                'iss'   =>  "localhost",
                'aud'   =>  "localhost",
                'iat'   =>  time(),
                'exp'   =>  time() + 3600,
                'email' =>  $email
            ];
            
            $jwt    =   JWT::encode($payload, $this->secret, 'HS256');
            echo json_encode(['token' => $jwt]);
            return;

        }
        http_response_code(401);
        echo json_encode(['error' => 'Inavlid Credentials']);

    }

    public function protectedRoute()
    {

        $authHeader = null;
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            if (isset($headers['Authorization'])) {
                $authHeader = $headers['Authorization'];
            } elseif (isset($headers['authorization'])) {
                $authHeader = $headers['authorization'];
            }
        }


        if (!$authHeader && isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        }
        
        if (!$authHeader) {
            http_response_code(401);
            echo json_encode(['error' => 'No token found in headers']);
            return;
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            echo json_encode(['message' => 'Access granted', 'user' => $decoded->email]);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token', 'debug' => $e->getMessage()]);
        }
    }
}
