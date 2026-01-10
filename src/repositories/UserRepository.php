<?php

use Database\Database;
use Src\Models\User;


class UserRepository {
    

    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function findById($id) {
        
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['username'], $row['email'], $row['password'], $row['id']);
        }
        return null;
    }

    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['username'], $row['email'], $row['password'], $row['id']);
        }
        return $users;
    }

    public function findByEmail($email) {
        
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['username'], $row['email'], $row['password'], $row['id']);
        }
        return null;
    }

    public function createUser(User $user) {

        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);

    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>