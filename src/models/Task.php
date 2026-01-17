<?php 
    namespace App\models;
    use App\Models\BaseEntity;
    class Task extends BaseEntity{
       
        private $id;
        private $title;
        private $description;
        private $status;

        public function __construct( $title, $description, $status = 'pending', $id = null) {
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->status = $status;
        }

        public function getId() {
            return $this->id;
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
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,

            ];
        }
    }