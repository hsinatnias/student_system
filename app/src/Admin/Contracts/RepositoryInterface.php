<?php

namespace Home\Solid\Admin\Contracts;

interface RepositoryInterface
{

    public function findById(int $id): array;
    public function getAll(): array;
    public function create(array $data): array;
    public function update(int $id, array $data): array;
    public function delete(int $id): bool;
    


}