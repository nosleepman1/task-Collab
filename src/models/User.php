<?php 
    namespace App\models;
    use App\Models\BaseEntity;
    
    class User extends BaseEntity {
        private string $firstname;
        private string $lastname;
        private string $email;
        private string $password;
        private ?bool $is_active = true;
        private ?string $role = 'member';
        private ?string $avatar = null;
        

       public function __construct(string $firstname = '', string $lastname = '', string $email = '', string $password = '') {
            parent::__construct();
            $this->lastname = $lastname;
            $this->firstname = $firstname;
            $this->email = $email;
            $this->password = $password; // Hash the password upon setting
        }

        


        public function getFirstname() {
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

        public function getAvatar() {
            return $this->avatar;
        }

        public function getFullname() {
            return " {$this->firstname}  {$this->lastname}";
         }


         public function getInitials() {
            $first = $this->firstname ? $this->firstname[0] : '';
            $last = $this->lastname ? $this->lastname[0] : '';
            return $first . $last;
         }

        /**
         * 
         */

        public function setFirstname(string $firstname): self {
            $this->firstname = $firstname;
            return $this;
        }

        public function setLastname(string $lastname): self {
            $this->lastname = $lastname;
            return $this;
        }

        public function setEmail(string $email): self {
            $this->email = $email;
            return $this;
        }

        public function setAvatar(?string $avatar): self {
            $this->avatar = $avatar;
            return $this;
        }



        public function setRole(?string $role): self {
            in_array($role, ['admin', 'member']);
            $this->role = $role;
            return $this;
        }

        public function setIsActive(bool $active){
            $this->is_active = $active;
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

         

         public function isActive(){
            return $this->is_active;
         }

        

        
         public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,

                'firstname' => $this->getFirstname(),
                'lastname' => $this->getLastname(),
                'email' => $this->getEmail(),
                'password' => $this->getPassword(),
                'role' => $this->getRole(),
                'is_active' => $this->isActive(),

                'avatar' => $this->getAvatar() ? $this->getAvatar() : null,
                'fullname' => $this->getFullname(),
                'initials' => $this->getInitials(),
            ];
        }
         
    }