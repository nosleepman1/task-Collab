<?php 

    use App\Models\BaseEntity;


    class Project extends BaseEntity {

        private string $title;
        private string $description;
        private int $user_id;
        




        public function __construct(string $title = '', string $description) {
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

        public function setUserId(int $userId): self {
            $this->user_id = $userId;
            return $this;
        }
        

        public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'user_id' => $this->getUserId(),
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null
            ];
        }
    }