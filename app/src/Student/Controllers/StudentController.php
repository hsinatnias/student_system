<?php

namespace Home\Solid\Student\Controllers;

use Home\Solid\Student\Models\Student;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\ActivityService;

class StudentController{
    protected ActivityService $activityService;

    public function __construct(){
        $this->activityService = new ActivityService();
    }

    public function dashboard(){
        $activities = $this->activityService->getRecentActivities();
        $studentRepository = new StudentRepository();
        $data = $studentRepository->findById(1);

        $student = Student::fromArray($data);
        echo "<pre>";
        var_dump( $activities);
        echo "</pre>";

        
    }

}