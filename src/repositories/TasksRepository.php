<?php 
    
    namespace App\repositories;

use App\Config\Database;
use App\models\Task;
use App\Utils\Auth;
use DateTime;
use PDO;
use PDOException;

    class TasksRepository {

        private $db;   

        public function __construct()
        {
            $conn = Database::getInstance();
            $this->db = $conn->getConnection();
        }

        public function hydrate(array $data) : Task {
            $task = new Task();
            $task->setId((int)$data['id']);
            $task->setTitle($data['title']);
            $task->setDescription($data['description']);
            $task->setStatus($data['status']);
            $task->setUserId($data['user_id']);
            $task->setCreatedAt(DateTime::createFromFormat('Y-m-d h:i:s', $data['createdAt']));
            $task->setUpdatedAt(DateTime::createFromFormat('Y-m-d h:i:s', $data['updatedAt']));
            return $task;
        }



        public function create(Task $task) {

            if(!$task->getId()) {
                try{
                    $sql = "INSERT INTO tasks (title, description, status, user_id, createdAt, updatedAt) VALUES (:title, :description, :status, :user_id, NOW(), NOW()";
                    $stmt = $this->db->prepare($sql);
                    $result = $stmt->execute([
                        'title' => $task->getTitle(),
                        'description' => $task->getDescription(),
                        'status' => $task->getStatus(),
                        'user_id' => $task->getUserId(),
                    ]);

                    if($result){
                        return $task;
                    }
                    return null;

                } catch (PDOException $e){
                    
                }
            } else {
                try {
                    $sql = "UPDATE tasks SET title = :title, description = :description, status = :status, updatedAt = NOW() WHERE id = :id";
                    $stmt = $this->db->prepare($sql);   
                    $stmt->execute([
                        'title' => $task->getTitle(),
                        'description' => $task->getDescription(),
                        'status' => $task->getStatus(),
                        'id' => $task->getId()
                    ]);
                    
                } catch (PDOException $e) {
                    
                }
            }
                
        }


        public function myTasks(int $userId) {

            try {

                $sql = "SELECT * FROM tasks WHERE userId = :userId";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['userId' => $userId]);
                $result = $stmt->fetchAll();

                

                


            } catch (PDOException) {

            }
        }

        
        
    }