<?php 



    namespace App\models;


    class TaskProject extends BaseEntity {

        private int $user_id;
        private int $project_id;
        private int $task_id;


        public function __construct($user_id = '', $project_id = '', $task_id = '')
        {
            parent::__construct();
            $this->user_id = $user_id;
            $this->project_id = $project_id;
            $this->task_id = $task_id;
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
        public function getTaskId() {
            return $this->task_id;
        }


        public function toArray(): array
        {
            return [
                'user_id' => $this->user_id,
                'project_id' => $this->project_id,
                'task_id' => $this->task_id,
            ];
        }
    }