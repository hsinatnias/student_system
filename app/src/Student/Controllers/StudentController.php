<?php

namespace Home\Solid\Student\Controllers;


use Home\Solid\Student\Contracts\ActivityServiceInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Services\CreateStudentService;
use Home\Solid\Core\BaseController;
use Home\Solid\Student\Services\UpdateStudentService;

class StudentController extends BaseController{
    private  ActivityServiceInterface $activityService;
    private  StudentRepositoryInterface $studentRepository;

    public function __construct(
        ActivityServiceInterface $activityService,
        StudentRepositoryInterface $studentRepository
    ){
        $this->activityService = $activityService;
        $this->studentRepository = $studentRepository;
    }
    
    public function index()
    {
        $user = $this->authenticate();
        
        $students = $this->studentRepository->getAll();
        $this->jsonResponse($students);
    }

    public function show()
    {
        $user = $this->authenticate();

        $id = (int) ($_GET['id'] ?? 0);
        if (!$id) {
            $this->jsonResponse(['error' => 'Missing ID'], 400);
            return;
        }

        try {
            $student = $this->studentRepository->findById($id);
            $this->jsonResponse($student);
        } catch (\Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }
    }

    public function create()
    {
        $user = $this->authenticate();

        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['name'], $input['email'])) {
            $this->jsonResponse(['error' => 'Name and Email are required.'], 400);
            return;
        }

        $student = $this->studentRepository->create($input);
        $this->jsonResponse($student, 201);
    }

    public function update()
    {
        $user = $this->authenticate();

        $input = json_decode(file_get_contents("php://input"), true);
        $id = (int) ($_GET['id'] ?? 0);

        if (!$id || !isset($input['name'], $input['email'])) {
            $this->jsonResponse(['error' => 'ID, Name and Email are required.'], 400);
            return;
        }

        try {
            $student = $this->studentRepository->update($id, $input);
            $this->jsonResponse($student);
        } catch (\Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }
    }

    public function delete()
    {
        $user = $this->authenticate();

        $id = (int) ($_GET['id'] ?? 0);

        if (!$id) {
            $this->jsonResponse(['error' => 'ID is required.'], 400);
            return;
        }

        $deleted = $this->studentRepository->delete($id);

        $this->jsonResponse(['deleted' => $deleted]);
    }


}