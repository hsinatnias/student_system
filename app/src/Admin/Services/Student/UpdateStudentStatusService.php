<?php

namespace Home\Solid\admin\Services\Student;

use Home\Solid\admin\Repositories\StudentRepository;

class UpdateStudentStatusService{
    protected StudentRepository $repository;

    public function __construct(StudentRepository $studentRepository)
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