<?php

namespace Home\Solid\Student\Services;

use Home\Solid\Student\Contracts\StudentRepositoryInterface;

class DeleteStudentService
{
    private StudentRepositoryInterface $repository;

    public function __construct(StudentRepositoryInterface $repository)
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
