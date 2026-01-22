<?php

namespace App\repositories;
use App\models\BaseEntity;
use App\models\User;

use PDO;
use PDOException;

class UserRepository extends BaseRepository {
    
    protected string $tableName = 'users';
    

    protected function hydrate(array $data) : User {
        $user = new User();
        $user->setId((int)$data['id']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        $user->setPasswordHash($data['password']);
        $user->setRole($data['role']);
        $user->setAvatar($data['avatar']);
        $user->setCreatedAt($data['created_at']);
        $user->setUpdatedAt($data['updated_at']);
        return $user;

    }


    public function findByEmail($email) {
        try{
            $sql = "SELECT * FROM {$this->tableName} WHERE email = :email";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch();

            if ($result) {
                return $this->hydrate($result);
            }
            return null;
        }catch (PDOException $e) {
            $this->logError($e);
        }
    }

    public function create(User $user) {

        if (!$user->getId()) {
            $sql  = "INSERT INTO {$this->tableName} (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'firstname' => $user->getFirsname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
            return $user;
        } else {
            $sql = "UPDATE {$this->tableName} SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'firstname' => $user->getFirsname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'id' => $user->getId()
            ]);
            return $user;
        }
    }

    
    
}