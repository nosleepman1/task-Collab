<?php 

    class taskMiddleware {

        public static function validate($title, ) {
            if (strlen($title) <= 4) {
                $_SESSION["TaskMiddleware"]["title"] = "Le titre doit au moins contenir 5 caracteres";
                header("Location: /create");
                exit;
            }
        }   
    }