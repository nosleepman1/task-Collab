<?php 
    namespace App\models;
    use App\Models\BaseEntity;
    class Task extends BaseEntity{
       
        private $id;
        private $title;
        private $description;
        private $status = 'pending';
        private int $user_id;

        public function __construct( $title = '', $description = '', $status = 'pending', $user_id = null) {
            parent::__construct();
            $this->title = $title;
            $this->description = $description;
            $this->status = $status;
            $this->user_id = $user_id;
        }


        
        public function setUserId(int $userId) :self {
            $this->user_id = $userId;
            return $this;
        }

        public function getUserId() {
            return $this->user_id;
        }


        public function setTitle(string $title): self {
            $this->title = $title;
            return $this;
        }

        public function setDescription(string $description): self {
            $this->description = $description;
            return $this;
        }

        public function setStatus(string $status): self {
            $this->status = $status;
            return $this;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getStatus() {
            return $this->status;
        }

        public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'status' => $this->getStatus(),
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }
    }