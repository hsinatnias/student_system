<?php

namespace Home\Solid\Student\Services;

use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Models\Student;

class CreateStudentService{

    protected StudentRepositoryInterface $repository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->repository = $studentRepository;
    }
    
    public function handle(array $data){
        if(empty($data['name']) || empty($data['email'])) {
            throw new \InvalidArgumentException('Name and email are required.');
        }

        return $this->repository->create($data);

    }

}