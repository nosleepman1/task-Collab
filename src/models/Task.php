<?php 

    class Task {
       
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
    }