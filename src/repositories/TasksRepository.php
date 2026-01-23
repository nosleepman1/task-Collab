<?php 
    
namespace App\repositories;

use App\Config\Database;
use App\models\Task;
use DateTime;
use PDO;
use PDOException;

    class TasksRepository extends BaseRepository{

        protected string $tableName = 'tasks';



        public function hydrate(array $data) : Task {
            $task = new Task();
            $task->setId((int)$data['id']);
            $task->setTitle($data['title']);
            $task->setDescription($data['description']);
            $task->setStatus($data['status']);
            $task->setUserId($data['user_id']);
            $task->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']));
            $task->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
            return $task;
        }



        public function create(Task $task) {

            if(!$task->getId()) {
                try{
                    $sql = "INSERT INTO {$this->tableName} (title, description, status,  createdAt, updatedAt, user_id) VALUES (:title, :description, :status, NOW(), NOW(), :user_id)";
                    $stmt = $this->pdo->prepare($sql);
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
                    $this->logError($e);
                    return null;
                }
            } else {
                try {
                    $sql = "UPDATE {$this->tableName} SET title = :title, description = :description, status = :status, updatedAt = NOW() WHERE id = :id ";
                    $stmt = $this->pdo->prepare($sql);   
                    $stmt->execute([
                        'title' => $task->getTitle(),
                        'description' => $task->getDescription(),
                        'status' => $task->getStatus(),
                        'id' => $task->getId()
                    ]);
                    return $task;
                } catch (PDOException $e) {
                    $this->logError($e);
                    return null;
                }
            }
                
        }


        public function myTasks(int $user_id) {
            try {

                $sql = "SELECT * FROM {$this->tableName} WHERE user_id = :user_id ORDER BY createdAt DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['user_id' => $user_id]);
                $result = $stmt->fetchAll();
                return $this->hydrateMultiple($result);
                
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }

        
        
    }