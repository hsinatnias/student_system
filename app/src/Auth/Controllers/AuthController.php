<?php

namespace Home\Solid\Auth\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Home\Solid\Auth\Repositories\AuthRepository;

class AuthController{
    private string $secret;
    private AuthRepository $auth;

    public function __construct(AuthRepository $authRepository){
    
        $this->secret = $_ENV['JWT_SECRET'] ?? 'secret123';
        $this->auth = $authRepository;
        
    }

    public function register(){
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $role = 'student';

        if($this->auth->findByEmail($email)){
            http_response_code(409);
            echo json_encode(['error' => 'Email already exists']);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = $this->auth->createUser($email, $hashedPassword, $role);
        echo json_encode(['message'=> 'User registered successfully', 'user' => $user]);
    }

    public function login(){
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->auth->findByEmail($email);
        
        
        if(!$user || !password_verify($password, $user['password'])){

            http_response_code(401);
            echo json_encode(['error' => 'Invalid Credentials']);
            return;
        }

            $payload = [                
                'iat'   =>  time(),
                'exp'   =>  time() + 3600,
                'email' =>  $user['email'],
                'role'  =>  $user['role'],
                'userID'=>  $user['id'],
            ];
            
            $jwt    =   JWT::encode($payload, $this->secret, 'HS256');
            echo json_encode(['token' => $jwt]);
            return;     

    }

    public function adminOnlyRoute(){
        $decoded = $this->authenticate();
        if($decoded->role !== 'admin'){
            http_response_code(403);
            echo json_encode(['error'=> 'Admin only']);
            return;
        }
        echo json_encode(['message' => 'Welcome, Admin']);
    }

    private function authenticate()
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
            return JWT::decode($token, new Key($this->secret, 'HS256'));
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized', 'debug' => $e->getMessage()]);
            exit;
        }
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
