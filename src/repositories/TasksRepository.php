<?php 
    
    namespace App\repositories;

use App\Config\Database;
use App\models\Task;

    class TasksRepository {

        private $db;   

        public function __construct()
        {
            $conn = Database::getInstance();
            $this->db = $conn->getConnection();
        }


        public function create(Task $task) {

            $sql = "INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus()
            ]);
            return $task;
        }
        }
        
    }