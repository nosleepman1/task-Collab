<?php 
    namespace App\Models;
    use DateTime;

    abstract class BaseEntity {

        private ?int $id = null;
        private ?DateTime $createdAt = null;
        private ?DateTime $updatedAt = null;

        public function __construct() {
            if ($this->createdAt == null) {
                $this->createdAt = new DateTime();
            }
        }

        public function getId(){
            return $this->id;
        }

        public function getCreatedAt() {
            return $this->createdAt;
        }

        public function getUpdatedAt() {
            return $this->updatedAt;
        }

        public function setId(int $id) :self{
            $this->id = $id;
            return $this;
        }

        public function setCreatedAt(DateTime $date): self  {
            $this->createdAt = $date;
            return $this;
        }

        public function setUpdatedAt(DateTime $date): self  {
            $this->updatedAt = $date;
            return $this;
        }


        public function touch(DateTime $date): self  {
            $this->updatedAt = new DateTime();
            return $this;
        }


       


        /**
         * utils
         */

        public function exist() :bool{
            return $this->id !== null;
        }
        

        public function findOrFail(int $id) {
            if ($id === null) {
                throw new \Exception('Pas d\'ID');
            } 
            return $this->id;
        }

        abstract public function toArray() : array;
    }
   
    