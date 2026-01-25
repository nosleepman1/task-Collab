<?php 



    namespace App\models;


    class TaskProject extends BaseEntity {

        private int $project_id;
        private int $task_id;


        public function __construct($user_id = '', $project_id = '', $task_id = '')
        {
            parent::__construct();
            $this->project_id = $project_id;
            $this->task_id = $task_id;
        }


        /**
         * GETTERS
         */


        public function getProjectId() {
            return $this->project_id;
        }
        public function getTaskId() {
            return $this->task_id;
        }


        /**
         * SETTERS
         * @return self
         * pour chainage
         */
        public function setProjectId(int $projectId): self {
            $this->project_id = $projectId;
            return $this;
        }   

        public function setTaskId(int $taskId): self {
            $this->task_id = $taskId;
            return $this;
        }


        public function toArray(): array
        {
            return [
                'project_id' => $this->project_id,
                'task_id' => $this->task_id,

                'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'updatedAt' => $this->getUpdatedAt() ? $this->getUpdatedAt()->format('Y-m-d H:i:s') : null
            ];
        }
    }