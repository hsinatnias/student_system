<?php

namespace Home\Solid\Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class BaseController
{
    protected function authenticate(): object
    {
        $secret = $_ENV['JWT_SECRET'] ?? 'secret123';
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
            $this->jsonResponse(['error' => 'No token found in headers'], 401);            
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            return JWT::decode($token, new Key($secret, 'HS256'));
        } catch (\Exception $e) {
            $this->jsonResponse(['error' => 'Invalid token', 'message' => $e->getMessage()], 401);
            exit;
        }
    }

    protected function jsonResponse(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function getJsonInput(): array
    {
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput, true);

        return is_array($data) ? $data : [];
    }

    protected function authorize(string $requiredRole): void {
        $user = $this->authenticate();
        if ($user->role !== $requiredRole) {
            $this->jsonResponse(['error' => 'Forbidden'], 403);
            exit;
        }
    }
}
