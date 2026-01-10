<?php
    class UserMiddleware {

        public static function dataValidation ($username, $password, $email ) { 


            if (!$email || !$password || !$username) {
                $_SESSION['UserMiddleware']['champVide'] = 'Veuillez remplir tous les champs';
                header('Location: /register');
                exit;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                $_SESSION['UserMiddleware']['invalideMail'] = 'Addrese Mail invalide';
                header('Location: /register');
                exit;
            }

            $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
            if(!preg_match($regex, $password) ) {
                $_SESSION['UserMiddleware']['invalidePass'] = 'Mot de passe invalide';
                header('Location: /register');
                exit;
            }

        }
    }