<?php 

   namespace App\models;

    class ProjectUser extends BaseEntity {
    
         private int $user_id;
         private int $project_id;
         private string $role;

        public function __construct($user_id = '', $project_id = '', $role = '')
        {
            parent::__construct();
            $this->user_id = $user_id;
            $this->project_id = $project_id;
            $this->role = $role;
        }

        /**
         * GETTERS
         */

        public function getUserId() {
            return $this->user_id;
        }
        public function getProjectId() {
            return $this->project_id;
        }

        public function getRole() {
            return $this->role;
        }

        /**
         * SETTERS
         */
        public function setUserId(int $user_id): self {
            $this->user_id = $user_id;
            return $this;
        }
        public function setProjectId(int $project_id): self {
            $this->project_id = $project_id;
            return $this;
        }

        public function setRole(string $role): self {
            in_array($role, ['owner', 'member']);
            $this->role = $role;
            return $this;
        }

        
        public function toArray(): array
        {
            return [
                'user_id' => $this->user_id,
                'project_id' => $this->project_id,
                'role' => $this->role,
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null
            ];
        }
    }