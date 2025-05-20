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

        // Get Authorization header from various sources
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;
        }

        if (!$authHeader && isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        }

        if (!$authHeader) {
            $this->jsonResponse(['error' => 'Authorization token not provided'], 401);
            exit;
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
    }

    protected function getJsonInput(): array
    {
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput, true);

        return is_array($data) ? $data : [];
    }
}
