<?php

namespace Home\Solid\Student\Controllers;

use Home\Solid\Helpers\View\View;
use Home\Solid\Student\Contracts\ActivityServiceInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Models\Student;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\ActivityService;

class DashboardController{
    private  ActivityServiceInterface $activityService;
    private  StudentRepositoryInterface $studentRepository;

    public function __construct(
        ActivityServiceInterface $activityService,
        StudentRepositoryInterface $studentRepository
    ){
        $this->activityService = $activityService;
        $this->studentRepository = $studentRepository;
    }

    public function index(): void{
        $activities = $this->activityService->getRecentActivities();
        $studentData = $this->studentRepository->findById(1);
        $allStudentData = $this->studentRepository->getAll();

        // echo "<h2>Dashboard</h2><pre>";
        // print_r($studentData);
        // print_r($activities);
        // print_r($allStudentData);
        // echo "</pre>";
        View::render('Student/index', ['students' => $allStudentData]);

        
    }

}