<?php

namespace Home\Solid\Student\Contracts;

Interface StudentRepositoryInterface
{
    public function findById(int $id): array;

    public function getAll(): array;
}