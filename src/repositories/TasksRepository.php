<?php 

    require_once __DIR__ ."/../../database/Database.php";
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

        public function createTask($title, $description, $id_user) {
            $query = $this->db->prepare("INSERT INTO tasks (title, description, userId) VALUES (?,?,?)");
            $query->execute([$title, $description, $id_user]);
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