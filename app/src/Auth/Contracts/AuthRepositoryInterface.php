<?php

namespace Home\Solid\Auth\Contracts;

interface AuthRepositoryInterface{

    public function findByEmail(string $email): ?array;
    public function createUser(array $data): ?array;
    public function findById(int $id): ?array;
}