<?php

namespace Home\Solid\Auth\Contracts;

interface AuthRepositoryInterface{

    public function findByEmail(string $email): ?array;
}