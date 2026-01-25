<?php

namespace App\repositories;
use App\models\BaseEntity;
use App\models\ProjectUser;
use App\models\User;
use DateTime;
use PDO;
use PDOException;

    class ProjectUserRepository extends BaseRepository{

        protected string $tableName = 'project_user';

        public function hydrate(array $data) : ProjectUser {
            $projectUser = new ProjectUser();
            $projectUser->setId((int)$data['id']);
            $projectUser->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
                 
            return $projectUser;
        }

        public function addUserToProject(int $projectId, int $userId) : ?BaseEntity {
            try {
                $sql = "INSERT INTO {$this->tableName} (project_id, user_id, createdAt, updatedAt) VALUES (:project_id, :user_id, NOW(), NOW())";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute([
                    'project_id' => $projectId,
                    'user_id' => $userId
                ]);

                if($result){
                    $data = [
                        'id' => (int)$this->pdo->lastInsertId(),
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