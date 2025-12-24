<?php

use PHPUnit\Util\Json;

    require_once __DIR__ . '/../middlewares/taskValidations.php';
    require_once __DIR__ .'/../models/Task.php';
    require_once __DIR__ .'/../repositories/TasksRepository.php';

    //send json
    header('Content-Type: application/json');


    class TaskController {
        private $taskRepo;

        public function __construct() {
            $this->taskRepo = new TasksRepository() ;
        }
        
        public function index()  {
            $tasks = $this->taskRepo->All();
            echo json_encode([
                'tasks' => $tasks,
                 'status' => 200
            ]);
        }


    }