<?php

namespace Home\Solid\Admin\Contracts;

interface AdminRepositoryInterface{
    public function index();
    public function registerStudent(): ?array;
    public function registerFaculty(): ?array;
    
}