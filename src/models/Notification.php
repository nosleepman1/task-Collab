<?php 

    namespace App\models;
    use App\Models\User;
    


    class Notification extends BaseEntity {

        private  User $user;
        private string $message;
        private bool $is_read = false;


        public function __construct( User $user, string $message, bool $is_read = false) {
            parent::__construct();
            $this->user = $user;
            $this->message = $message;
            $this->is_read = $is_read;
        }

        /**
         * GETTERS
         */

        public function getUser() {
            return $this->user; 
        }

        public function getMessage() {
            return $this->message;
        }

        public function getIsRead() {
            return $this->is_read;
        }

        /**
         * SETTERS
         */

        public function setUser(User $user): self {
            $this->user = $user;
            return $this;
        }

        public function setMessage(string $message): self {
            $this->message = $message;
            return $this;
        }

        public function setIsRead(bool $is_read): self {
            $this->is_read = $is_read;
            return $this;
        }

        public function toArray(): array
        {
            return [
                'user_id' => $this->user->getId(),
                'message' => $this->message,
                'is_read' => $this->is_read,
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }
    }