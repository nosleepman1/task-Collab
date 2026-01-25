<?php 

    namespace App\models;

    class Notification extends BaseEntity {

        private int $user_id;
        private string $message;
        private bool $is_read = false;


        public function __construct( $user_id = '', $message = '', $is_read = false) {
            parent::__construct();
            $this->user_id = $user_id;
            $this->message = $message;
            $this->is_read = $is_read;
        }

        /**
         * GETTERS
         */

        public function getUserId() {
            return $this->user_id;
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

        public function setUserId(int $user_id): self {
            $this->user_id = $user_id;
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
                'user_id' => $this->user_id,
                'message' => $this->message,
                'is_read' => $this->is_read,
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }
    }