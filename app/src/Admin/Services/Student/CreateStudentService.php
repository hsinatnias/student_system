<?php

namespace Home\Solid\Admin\Services\Student;

use Home\Solid\Admin\Contracts\RepositoryInterface;

class CreateStudentService{

    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $adminRespository)
    {
        $this->repository = $adminRespository;
    }
    
    public function handle(array $data){
        if(empty($data['name']) || empty($data['email'])) {
            throw new \InvalidArgumentException('Name and email are required.');
        }

        return $this->repository->create($data);

    }

}