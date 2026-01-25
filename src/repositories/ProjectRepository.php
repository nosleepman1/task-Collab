<?php 

namespace App\repositories;

use App\Models\Project;
use App\repositories\BaseRepository;
use DateTime;
use App\Utils\Auth;


    class ProjectRepository extends BaseRepository {

        protected $tableName = 'projects';


        public function hydrate(array $data) : Project
        {
            $project = new Project($data['title'], $data['description']);
            $project->setId((int)$data['id']);
            $project->setUserId((int)$data['user_id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']))
                ->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
            
            return $project;
        }

        public function save(Project $project){

            if (!$project->getId()) {

                try {

                    $sql = "INSERT INTO {$this->tableName} (title, description, user_id, createdAt, updatedAt) VALUES (:title, :description, :user_id, NOW(), NOW())";
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
    }   