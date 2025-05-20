<?php

namespace Home\Solid\Student\Services;

use Home\Solid\Student\Contracts\StudentRepositoryInterface;

class UpdateStudentService{
    protected StudentRepositoryInterface $repository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->repository = $studentRepository;
    }

    public function handle(int $id, array $data){
        if (!$this->repository->findById($id)) {
            throw new \Exception("Student not found.");
        }

        return $this->repository->update($id, $data);
    }
}