<?php 

    namespace App\models;
    use App\Models\BaseEntity;
    
    class User extends BaseEntity {
       
        private $id;
        private string $firstname;
        private string $lastname;
        private $email;
        private $password;
        private ?bool $is_active = true;
        private ?string $role = 'member' ;
        

        public function __construct($firstname, $lastname, $email, $password) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            parent::__construct();
        }

        

        public function getId() {
            return $this->id;
        }

        public function getFirsname() {
            return $this->firstname;
        }

        public function getLastname() {
            return $this->lastname;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword(string $password): self {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
            return $this;
        }

         public function setPasswordHash(string $passwordHashed) : self{
                $this->password = $passwordHashed;
                return $this;
         }


         public function verifyPassword(string $password) : bool{
                return $this->password = password_verify($this->password, $password);      
         }

         public function getFullname() {
            return " {$this->firstname}  {$this->lastname}";
         }


         public function getInitials() {
            $first = $this->firstname ? $this->firstname[0] : '';
            $last = $this->lastname ? $this->lastname[0] : '';
            return $first . $last;
         }

        
         public function toArray(): array
        {
            return [
                'id' => $this->id,
                'createdAt' => $this->create
            ];
        }
         
    }