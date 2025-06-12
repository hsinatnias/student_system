<?php

namespace Home\Solid\Auth\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Home\Solid\Auth\Repositories\AuthRepository;
use Home\Solid\Core\BaseController;

class AuthController extends BaseController{
    private string $secret;
    private AuthRepository $auth;

    public function __construct(AuthRepository $authRepository){
    
        $this->secret = $_ENV['JWT_SECRET'] ?? 'secret123';
        $this->auth = $authRepository;
        
    }

    public function register(){
        $data = json_decode(file_get_contents('php://input'), true);       

        $data['role'] = 'student';

        if($this->auth->findByEmail($data['email'])){            
            $this->jsonResponse(['error' => 'Email already exists'], 409);           
        }

        
        $user = $this->auth->createUser($data);
        $this->jsonResponse(['message'=> 'User registered successfully', 'user' => $user]);         
    }

    public function login(){
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->auth->findByEmail($email);
        
        
        if(!$user || !password_verify($password, $user['password'])){

            $this->jsonResponse(['error' => 'Invalid Credentials'], 401);
        }

            $payload = [                
                'iat'   =>  time(),
                'exp'   =>  time() + 3600,
                'email' =>  $user['email'],
                'role'  =>  $user['role'],
                'userID'=>  $user['id'],
            ];
            
            $jwt    =   JWT::encode($payload, $this->secret, 'HS256');
            $this->jsonResponse(['token' => $jwt]);

    }

    public function adminOnlyRoute(){
        $decoded = $this->authenticate();
        if($decoded->role !== 'admin'){
            $this->jsonResponse(['error'=> 'Admin only'], 403);            
        }
        $this->jsonResponse(['message' => 'Welcome, Admin']);
    }
    
    public function me()
    {
        $decoded = $this->authenticate();
        $user = $this->auth->findById($decoded->userID);

        if (!$user) {
            $this->jsonResponse(['error' => 'User not found'], 404);
            return;
        }

        $this->jsonResponse(['user' => $user]);
    }

    
    
}
