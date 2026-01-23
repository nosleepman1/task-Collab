<?php 
    
    namespace App\repositories;

use App\Config\Database;
use App\models\Task;

    class TasksRepository {

        private $db;   

        public function __construct()
        {
            $conn = Database::getInstance();
            $this->db = $conn->getConnection();
        }
        
    }