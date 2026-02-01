<?php

namespace App\repositories;
use App\models\User;
use DateTime;
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
        $user->setIsActive($data['is_active']);
        $user->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']));
        $user->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
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
            $sql  = "INSERT INTO {$this->tableName} (firstname, lastname, email, password, createdAt, updatedAt) VALUES (:firstname, :lastname, :email, :password, NOW(), NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
            return $user;
        } else {
            $sql = "UPDATE {$this->tableName} SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'id' => $user->getId()
            ]);
            return $user;
        }
    }



    public function showAvalaibleMembers() {
        try {
            $sql = "SELECT * FROM {$this->tableName} WHERE role = 'member'";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->fetchAll();
            return $this->hydrateMultiple($result); 
        } catch (PDOException $e) {
            $this->logError($e);
        }
    }
 
}