<?php 

namespace App\repositories;
use App\Config\Database;
use App\Models\BaseEntity;
use PDO;
use PDOException;

    abstract class BaseRepository {
      
        protected PDO $pdo;
        protected string $tableName;
        
        public function __construct() {
           $conn = Database::getInstance();
           $this->pdo = $conn->getConnection();
        }

        abstract protected function hydrate(array $data) : BaseEntity;

        public function hydrateMultiple(array $results): array {
            $entities = [];

            foreach($results as $result) {
                $entities[] = $this->hydrate($result);
        }

            return $entities;
        }

        protected function LastInsertId() {
            return $this->pdo->lastInsertId();
        }


        public function All() {
            $query = "SELECT  * FROM  {$this->tableName}";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->hydrateMultiple($result);
        }

        public function find(int $id) {
            try {
                $sql = "SELECT * FROM {$this->tableName} WHERE id = :id ";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch();
                if($result) {
                    return $this->hydrate($result);
                } 
                return null;

            } catch (PDOException $e) {
                $this->logError($e);
            }
        }

        public function delete(int $id) {
            try {
                $sql = "DELETE FROM {$this->tableName} WHERE id = :id ";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                return $stmt->rowCount() > 0;
                
            } catch (PDOException $e) {
                $this->logError($e);

            }
        }

        protected function executeCommand($sql, array $params = []) {
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->rowCount() > 0;
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }

 

        protected function logError(PDOException $e) {
            $logFile = ROOT_PATH . '/logs/repository.log';

            if(!is_dir(dirname($logFile))) {
                mkdir(dirname($logFile), 0755, true);
            }
            $message = date('Y-m-d H:i:s') . "<br> Erreur PDO : " . $e->getMessage(). PHP_EOL;
            file_put_contents($logFile, $message, FILE_APPEND);
        }
        

        
    } 