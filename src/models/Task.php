<?php 
    namespace App\models;
    use App\Models\BaseEntity;
    use DateTime;

    class Task extends BaseEntity{
       
        private int $project_id;
        private int $user_id;
        private $title;
        private $description;
        private $status = 'pending';
        private string $priority = 'medium';
       
        private ?DateTime $deadline = null;
        


        public function __construct( $title = '', $description = '', $status = 'pending', $priority = 'medium',  $deadline = null) {
            parent::__construct();
            $this->title = $title;
            $this->description = $description;
            $this->status = $status;
            $this->priority = $priority;
            $this->deadline = $deadline;
        }


        
       
        /**
         * setters
         * @return self
         * pour chainage
         */

        public function setUserId(int $userId): self {
            $this->user_id = $userId;
            return $this;
        }

        public function setPriority(string $priority): self {
            $this->priority = $priority;
            return $this;
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

        public function setDeadline(DateTime $deadline): self {
            $this->deadline = $deadline;
            return $this;
        }

        public function setProjectId(int $projectId): self {
            $this->project_id = $projectId;
            return $this;
        }



        /**
         * getters
         */

        public function getUserId() {
            return $this->user_id;
        }


        public function getPriority() {
            return $this->priority;
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

        public function getDeadline() {
            return $this->deadline;
        }
    
        public function getProjectId() {
            return $this->project_id;
        }

        public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'project_id' => $this->getProjectId(),
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'status' => $this->getStatus(),
                'priority' => $this->getPriority(),
                'deadline' => $this->getDeadline() ? $this->getDeadline()->format('Y-m-d H:i:s') : null,
                
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }
    }