<?php

    namespace App\repositories;
    use App\models\ProjectUser;
    use App\repositories\ProjectRepository;
    use DateTime;
    use PDO;
    use PDOException;

    class ProjectMemberRepository extends BaseRepository {

        protected $tableName = 'project_members';


        public function hydrate(array $data) : ProjectUser
        {
            $userRepo = new UserRepository();
            $projectRepo = new ProjectRepository();

            $user = $userRepo->find((int)$data['user_id']);
            $project = $projectRepo->find((int)$data['project_id']);

            $projectMember = new ProjectUser($user, $project);
            $projectMember->setId((int)$data['id']);
            $projectMember->setRole($data['role'])
                ->setProject($project)
                ->setUser($user)
                ->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
            
            return $projectMember;
        }


        public function save(ProjectUser $projectMember){

            if (!$projectMember->getId()) {

                try {

                    $sql = "INSERT INTO {$this->tableName} (user_id, project_id, role, createdAt, updatedAt) VALUES (:user_id, :project_id, :role, NOW(), NOW())";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute(
                        [
                        'user_id' => $projectMember->getUser()->getId(),
                        'project_id' => $projectMember->getProject()->getId(),
                        'role' => $projectMember->getRole()
                    ]);

                    if ($result) {
                        return $projectMember;
                    }
                    return null;

                } catch (PDOException $e) {
                    $this->logError($e); 
                }
            } else {

                try {

                    $sql = "UPDATE {$this->tableName} SET user_id = :user_id, project_id = :project_id, role = :role, updatedAt = NOW() WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute(
                        [
                        'user_id' => $projectMember->getUserId(),
                        'project_id' => $projectMember->getProjectId(),
                        'role' => $projectMember->getRole(),
                        'id' => $projectMember->getId()
                    ]);

                    if ($result) {
                        return $projectMember;
                    }
                    return null;

                } catch (PDOException $e) {
                    $this->logError($e); 
                }
            }
        }
        

        public function findMembers(int $projectId) {
            try {
                $sql = "SELECT * FROM {$this->tableName} WHERE project_id = :project_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['project_id' => $projectId]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $this->hydrateMultiple($results);
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }

    }