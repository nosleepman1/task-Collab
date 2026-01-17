<?php 
    namespace App\models;
    use App\Models\BaseEntity;
    
    class User extends BaseEntity {
        private string $firstname;
        private string $lastname;
        private $email;
        private $password;
        private ?bool $is_active = true;
        private ?string $role = 'member' ;
        

        public function __construct($firstname, $lastname, $email, $password) {
            parent::__construct();
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $this->setPassword($password);
            
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

        public function getRole() {
            return $this->role;
        }

       

        

        /**
         * 
         */
        public function setRole(?string $role): self {
            in_array($role, ['admin', 'member']);
            $this->role = $role;
            return $this;
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
                return $this->password = password_verify($password, $this->password);      
         }

         public function getFullname() {
            return " {$this->firstname}  {$this->lastname}";
         }


         public function getInitials() {
            $first = $this->firstname ? $this->firstname[0] : '';
            $last = $this->lastname ? $this->lastname[0] : '';
            return $first . $last;
         }

         public function isActive(){
            return $this->is_active;
         }

        
         public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,

                'firstname' => $this->getFirsname(),
                'lastname' => $this->getLastname(),
                'email' => $this->getEmail(),
                'password' => $this->getPassword(),
                'role' => $this->getRole(),
                'is_active' => $this->isActive()
            ];
        }
         
    }