<?php 
    require_once __DIR__ . '/../models/User.php';
    require_once __DIR__ . '/../repositories/UserRepository.php';
    require_once __DIR__ . '/../middlewares/userValidations.php';
    
    class UserController {
        private $userRepo;

        public function __construct() {
            $this->userRepo = new UserRepository();
        }

        public function register() { 

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                

                $user = new User($username, $email, $password);

                try {
                    $this->userRepo->createUser($user);
                    header('Location: /login');
                    exit;
                } catch (Exception $e) {
                    header('Location: /register?error=registration_failed');
                    exit;
                }

            } else {
                require_once __DIR__ .'/../../views/auth/register.php';
            }
        }
       
        public function showProfile($userId) {
            
        }

        public function editProfile($userId, $data) {
            // Logique pour éditer le profil de l'utilisateur
        }

        public function deleteUser($userId) {
            // Logique pour supprimer un utilisateur
        }
    }