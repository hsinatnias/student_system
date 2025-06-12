<?php

namespace Home\Solid\Admin\Services\Student;

use Home\Solid\Admin\Contracts\RepositoryInterface;

class DeleteStudentService
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(int $id): bool
    {
        if (!$this->repository->findById($id)) {
            throw new \Exception("Student not found.");
        }

        return $this->repository->delete($id);
    }
}
