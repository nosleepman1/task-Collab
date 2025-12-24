<?php
    require_once __DIR__ . '/../models/User.php';
    class UserMiddleWare {

        public static function dataValidation ($username, $password, $email ) { 


            if (!$email || !$password | !$username) {
                header('location : /register?erreur=middlewareChamps');
                exit;
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                header('location : /register?erreur=invalideMail');
                exit;
            }

            $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
            if(!preg_match($regex, $password) ) {
                header('location : /register?erreur=invalidePassword');
                exit;
            }

        }
    }