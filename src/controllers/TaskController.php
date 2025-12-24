<?php

use PHPUnit\Util\Json;

    require_once __DIR__ . '/../middlewares/taskValidations.php';
    require_once __DIR__ .'/../models/Task.php';
    require_once __DIR__ .'/../repositories/TasksRepository.php';

    //send json


    class TaskController {
        private $taskRepo;

        public function __construct() {
            $this->taskRepo = new TasksRepository() ;
        }


        public function tasks()
        {
            
            if (!isset($_SESSION["authenticated"]) || !isset($_SESSION["user_id"])) {
                require_once __DIR__ . "/../../views/auth/authRequire.php";
            }

            $taskRepo = new TasksRepository();
            $userId = $_SESSION["user_id"];
            $tasks = $taskRepo->findTasksByUserId($userId);

            require_once __DIR__ . '/../../views/tasks/tasks.php';
        }


        public function create() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (isset($_SESSION['authenticated']) && isset($_SESSION['user_id'])) {
                    
                    $userId = $_SESSION['user_id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];

                   

                    $task = new Task($title, $description);

                    $this->taskRepo->createTask($task, $userId);

                    $this->tasks();
                }
            } else {
                $this->tasks();

            }
        }

    }