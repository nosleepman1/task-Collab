<?php 

    namespace App\repositories;
    use App\models\TaskProject;
    use PDOException;
    use DateTime;
    class TaskProjectRepository extends BaseRepository {
        protected string $tableName = 'tasks_projects';

        public function hydrate(array $data) : TaskProject {
            $taskProject = new TaskProject();
            $taskProject->setId((int)$data['id']);
            $taskProject->setProjectId((int)$data['project_id'])
                ->setTaskId((int)$data['task_id'])
                ->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
                 
            return $taskProject;
        }


        
        public function getTasksByProjectId(int $projectId) {
            try {
                $sql = "SELECT t.* FROM tasks t
                        INNER JOIN projects p ON t.project_id = p.id
                        WHERE p.id = :project_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['project_id' => $projectId]);
                $tasksData = $stmt->fetchAll();

                $tasks = [];
                foreach ($tasksData as $data) {
                    $tasks[] = (new TasksRepository())->hydrate($data);
                }
                return $tasks;

            } catch (PDOException $e) {
                $this->logError($e);
                return [];
            }
        }

        public function addTaskToProject(int $projectId, int $taskId)  {
            try {
                $sql = "INSERT INTO {$this->tableName} (project_id, task_id, createdAt, updatedAt) VALUES (:project_id, :task_id, NOW(), NOW())";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute([
                    'project_id' => $projectId,
                    'task_id' => $taskId
                ]);

                if($result){
                    $data = [
                        'id' => (int)$this->pdo->lastInsertId(),
                        'project_id' => $projectId,
                        'task_id' => $taskId,
                        'createdAt' => date('Y-m-d H:i:s'),
                        'updatedAt' => date('Y-m-d H:i:s')
                    ];
                    return $this->hydrate($data);
                }
                return null;

            } catch (PDOException $e){
                $this->logError($e);
                return null;
            }
        }

    }

    