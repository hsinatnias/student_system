<?php

namespace Home\Solid\Admin\Services\Student;

use Home\Solid\Admin\Contracts\RepositoryInterface;

class UpdateStudentService{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $studentRepository)
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