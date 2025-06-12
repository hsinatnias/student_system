<?php

namespace Home\Solid\Admin\Controllers;

use Exception;
use Home\Solid\Admin\Contracts\RepositoryInterface;
use Home\Solid\admin\Services\Student\UpdateStudentStatusService;
use Home\Solid\Core\BaseController;
use Home\Solid\Admin\Services\Student\CreateStudentService;
use Home\Solid\Admin\Services\Student\DeleteStudentService;
use Home\Solid\Admin\Services\Student\UpdateStudentService;

class StudentController extends BaseController{

    private CreateStudentService $createStudentService;
    private UpdateStudentService $updateStudentService;
    private DeleteStudentService $deleteStudentService;
    private UpdateStudentStatusService $updateStudentStatusService;
    private RepositoryInterface $studentRepository;

    public function __construct(
        CreateStudentService $createStudent,
        UpdateStudentService $updateStudent,
        DeleteStudentService $deleteStudent,
        UpdateStudentStatusService $updateStudentStatus,
        RepositoryInterface $studentRepository
        ){
        $this->createStudentService = $createStudent;
        $this->updateStudentService = $updateStudent;
        $this->deleteStudentService = $deleteStudent;
        $this->updateStudentStatusService = $updateStudentStatus;
        $this->studentRepository = $studentRepository;
    }

   

    /**
     * method to create a new student
     *
     * @return void
     */
    public function createStudent(){

        $this->authorize("admin");
        $data = $this->getJsonInput();

        try{
            $student = $this->createStudentService->handle($data);
            $this->jsonResponse($student, 201);
        }catch(Exception $e){
            $this->jsonResponse(['error'=> $e->getMessage()], 400);
        }
        
    }

    public function findAllStudents(){

         $this->authorize("admin");
        
        $students = $this->studentRepository->getAll();
        $this->jsonResponse($students);

    }

    public function findStudentById(int $id){

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

    public function updateStudent(){

        $user = $this->authenticate();
        $data = $this->getJsonInput();
        
        $id = (int) ($_GET['id'] ?? 0);

        try {
            $student = $this->updateStudentService->handle($id, $data);
            $this->jsonResponse($student);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }

    }
    public function deleteStudent(int $id){

        $user = $this->authenticate();
        $id = (int) ($_GET['id'] ?? 0);

        try{
            $deleted = $this->deleteStudentService->handle($id);
            $this->jsonResponse(['deleted' => $deleted]);
        }catch(Exception $e){
            $this->jsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    public function updateStatus(){
        $this->authorize("admin");

        $status = $this->getJsonInput()["status"] ??"";
        
        $id = (int) ($_GET['id'] ?? 0);

        try {
            $updatedStatus = $this->updateStudentStatusService->handle($id, $status);
            $this->jsonResponse(['status'=> $updatedStatus]);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 404);
        }


    }
    
}