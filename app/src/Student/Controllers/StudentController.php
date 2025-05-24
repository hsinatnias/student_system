<?php

namespace Home\Solid\Student\Controllers;



use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Core\BaseController;
use Home\Solid\Student\Services\CreateStudentService;
use Home\Solid\Student\Services\DeleteStudentService;
use Home\Solid\Student\Services\UpdateStudentService;
use Exception;

class StudentController extends BaseController{
    private CreateStudentService $createService;
    private UpdateStudentService $updateService;
    private DeleteStudentService $deleteService;
    private StudentRepositoryInterface $studentRepository;

    public function __construct(
        CreateStudentService $createService,
        UpdateStudentService $updateService,
        DeleteStudentService $deleteService,    
        StudentRepositoryInterface $studentRepository
        
    ){
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
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
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }
    }

    public function create()
    {
        $user = $this->authenticate();
        $data = $this->getJsonInput();        
        try{
            $student = $this->createService->handle($data);
            $this->jsonResponse($student, 201);
        }catch(Exception $e){
            $this->jsonResponse(['error'=> $e->getMessage()], 400);
        }
        
    }

    public function update()
    {
        $user = $this->authenticate();
        $data = $this->getJsonInput();
        
        $id = (int) ($_GET['id'] ?? 0);
        


        try {
            $student = $this->updateService->handle($id, $data);
            $this->jsonResponse($student);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }
    }

    public function delete()
    {
        $user = $this->authenticate();
        $id = (int) ($_GET['id'] ?? 0);

        try{
            $deleted = $this->deleteService->handle($id);
            $this->jsonResponse(['deleted' => $deleted]);
        }catch(Exception $e){
            $this->jsonResponse(['error' => $e->getMessage()], 400);
        }
    }


}