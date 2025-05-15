<?php

namespace Home\Solid\Student\Controllers;

use Home\Solid\Student\Contracts\ActivityServiceInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Models\Student;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\ActivityService;

class StudentController{
    private  ActivityServiceInterface $activityService;
    private  StudentRepositoryInterface $studentRepository;

    public function __construct(
        ActivityServiceInterface $activityService,
        StudentRepositoryInterface $studentRepository
    ){
        $this->activityService = $activityService;
        $this->studentRepository = $studentRepository;
    }

    public function dashboard(): void{
        $activities = $this->activityService->getRecentActivities();
        $studentData = $this->studentRepository->findById(1);
        $allStudentData = $this->studentRepository->getAll();

        echo "<h2>Dashboard</h2><pre>";
        print_r($studentData);
        print_r($activities);
        print_r($allStudentData);
        echo "</pre>";

        
    }

}