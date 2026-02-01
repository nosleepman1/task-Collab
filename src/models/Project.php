<?php 
    namespace App\models;
    use App\Models\BaseEntity;


    class Project extends BaseEntity {

        private string $title;
        private string $description;
        private User $owner;

        public function __construct(string $title, string $description) {
            parent::__construct();
            $this->title = $title;
            $this->description = $description;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getDescription() {
            return $this->description;
        }
     

        public function getOwner() {
            return $this->owner;
        }


        
        public function setOwner(User $owner): self {
            $this->owner = $owner;
            return $this;
        }


        public function setDescription(string $description): self {
            $this->description = $description;
            return $this;
        }
        public function setTitle(string $title): self {
            $this->title = $title;
            return $this;
        }
        

        public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'owner' => $this->getOwner()->getId(),
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null
            ];
        }
    }