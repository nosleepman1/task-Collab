<?php 

    require_once __DIR__ ."/../../database/Database.php";
    require_once __DIR__ ."/../models/Task.php";

    class TasksRepository {
        private $db;

        public function __construct() { 
            $this->db = Database::getInstance();
        }

        public function findTaskById($id) { 
            $query = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
            $query->execute([$id]);

            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            return $result;
        }

        public function createTask(Task $task, $id_user) {
            $query = $this->db->prepare("INSERT INTO tasks (title, description, userId) VALUES (?,?,?)");
            $query->execute([$task->getTitle(), $task->getDescription(), $id_user]);
        }

        public function findTasksByUserId($userId) {
            $query = $this->db->prepare("SELECT * FROM tasks WHERE userId = ? ORDER BY created_at DESC");
            $query->execute([$userId]);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $tasks = [];
            foreach ($results as $row) {
                $tasks[] = new Task($row['title'], $row['description'], $row['status'], $row['id']);
            }
            return $tasks;
        }

        public function All(){
            $query = $this->db->prepare("SELECT * FROM tasks");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function delete($id) {
            $query = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
            $query->execute(['id' => $id]);
        }
    }