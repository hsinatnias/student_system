<?php

namespace Home\Solid\Student\Repositories;

class StudentRepository{

    public function findById(int $id): array{
        return [
            'id'=> $id,
            'name'=> 'John Doe',
            'email'=> 'john@example.com'
        ];
    }
}