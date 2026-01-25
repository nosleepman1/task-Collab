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
            $task->setProjectId((int)$data['project_id'])
                ->setUserId((int)$data['user_id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setStatus($data['status'])
                ->setPriority($data['priority'])
                ->setDeadline($data['deadline'] ? new DateTime($data['deadline']) : null)
                ->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
                 
            return $task;
        }



        public function create(Task $task) {

            if(!$task->getId()) {
                try{
                    $sql = "INSERT INTO {$this->tableName} (title, description, status, createdAt, updatedAt, user_id, project_id, deadline, priority) VALUES (:title, :description, :status, NOW(), NOW(), :user_id, :project_id, :deadline, :priority)";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute([
                        'title' => $task->getTitle(),
                        'description' => $task->getDescription(),
                        'status' => $task->getStatus(),
                        'user_id' => $task->getUserId(),
                        'project_id' => $task->getProjectId(),
                        'deadline' => $task->getDeadline(),
                        'priority' => $task->getPriority()
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
                    $sql = "UPDATE {$this->tableName} SET title = :title, description = :description, status = :status, updatedAt = NOW(), project_id = :project_id, deadline = :deadline, priority = :priority WHERE id = :id ";
                    $stmt = $this->pdo->prepare($sql);   
                    $stmt->execute([
                        'title' => $task->getTitle(),
                        'description' => $task->getDescription(),
                        'status' => $task->getStatus(),
                        'project_id' => $task->getProjectId(),
                        'deadline' => $task->getDeadline(),
                        'priority' => $task->getPriority(),
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


        public function ProjectTasks(int $project_id) {
            try {

                $sql = "SELECT * FROM {$this->tableName} WHERE project_id = :project_id ORDER BY createdAt DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['project_id']);
                $result = $stmt->fetchAll();
                return $this->hydrateMultiple($result);
                
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }  
        
    }