<?php

namespace Home\Solid\Student\Services;

use Home\Solid\Student\Contracts\StudentRepositoryInterface;

class UpdateStudentStatusService{
    protected StudentRepositoryInterface $repository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->repository = $studentRepository;
    }

    public function handle(int $id, string $status){
        if (!$this->repository->findById($id)) {
            throw new \Exception("Student not found.");
        }

        return $this->repository->updateStatus($id,  $status);
    }
}