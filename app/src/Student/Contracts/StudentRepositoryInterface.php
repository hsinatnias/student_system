<?php

namespace Home\Solid\Student\Contracts;

Interface StudentRepositoryInterface
{
    public function findById(int $id): array;
    public function getAll(): array;
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function delete(int $id): bool;
    public function updateStatus(int $id, string $status): bool;
}