<?php 

   namespace App\models;

    class ProjectUser extends BaseEntity {
    
         private User $user;
         private Project $project;
        private string $role = 'member'; // 'owner' or 'member'

        public function __construct(User $user, Project $project)
        {
            parent::__construct();
            $this->user = $user;
            $this->project = $project;
        }
        

        /**
         * GETTERS
         */

        public function getUser() {
            return $this->user;
        }

        public function getProject() {
            return $this->project;
        }

        public function getUserId() {
            return $this->user->getId();
        }

        public function getProjectId() {
            return $this->project->getId();
        }

        public function getRole() {
            return $this->role;
        }


        /**
         * SETTERS
         */
        public function setUser(User $user): self {
            $this->user = $user;
            return $this;
        }

        public function setProject(Project $project): self {
            $this->project = $project;
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
                'user_id' => $this->user->getId(),
                'project_id' => $this->project->getId(),
                'role' => $this->role,
                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null
            ];
        }
    }