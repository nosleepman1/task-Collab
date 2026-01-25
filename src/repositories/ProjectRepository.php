<?php 

namespace App\repositories;

use App\Models\Project;
use App\repositories\BaseRepository;
use DateTime;
use App\Utils\Auth;
use PDOException;


    class ProjectRepository extends BaseRepository {

        protected $tableName = 'projects';


        public function hydrate(array $data) : Project
        {
            $project = new Project($data['title'], $data['description']);
            $project->setId((int)$data['id']);
            $project->setOwner(Auth::user())
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
            
            return $project;
        }

        public function save(Project $project){

            if (!$project->getId()) {

                try {

                    $sql = "INSERT INTO {$this->tableName} (title, description, owner, createdAt, updatedAt) VALUES (:title, :description, :owner, NOW(), NOW())";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute(
                        [
                        'title' => $project->getTitle(),
                        'description' => $project->getDescription(),
                        'owner' => Auth::user()->getId()
                    ]);

                    if ($result) {
                        return $project;
                    }
                    return null;

                } catch (PDOException $e) {
                    $this->logError($e); 
                }
            } else {

                try {

                    $sql = "UPDATE {$this->tableName} SET title = :title, description = :description, user_id = :user_id,  updatedAt = NOW()";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute(
                        [
                        'title' => $project->getTitle(),
                        'description' => $project->getDescription(),
                        'user_id' => Auth::user()->getId()
                    ]);

                    if ($result) {
                        return $project;
                    }
                    return null;

                } catch (PDOException $e) {
                    $this->logError($e); 
                }

            }
        }


        public function myProjects() {

            try {
                $sql = "SELECT * FROM {$this->tableName} WHERE owner = :owner";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['owner' => Auth::user()->getId()]);
                $results = $stmt->fetchAll();
                return $this->hydrateMultiple($results);
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }
    }   