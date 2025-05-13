<?php

namespace Home\Solid\Student\Models;

class Student{

    public int $id;
    public string $name;
    public string $email;
    public function __construct(int $id, string $name, string $email ){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public static function fromArray(array $data): self{
        return new self($data['id'], $data['name'], $data['email']);
    }
}