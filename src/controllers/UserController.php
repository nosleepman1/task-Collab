<?php 
    require_once __DIR__ . '/../models/User.php';
    require_once __DIR__ . '/../repositories/UserRepository.php';
    require_once __DIR__ . '/../middlewares/userValidations.php';
  
    //session_start();
    class UserController {
        private $userRepo;

        public function __construct() {
            $this->userRepo = new UserRepository();
        }

        public function register() { 

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];

                UserMiddleware::dataValidation($username, $password, $email);
                
                $user = new User($username, $email, $password);

                try {
                    $this->userRepo->createUser($user);
                    $_SESSION['registered'] = true;
                    header('Location: /login');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['error'] = 'registration_failed';
                    header('Location: /register');
                    exit;
                }

            } else {
                require_once __DIR__ .'/../../views/auth/register.php';
            }
        }


        public function login() {

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Vérifier que les champs requis sont présents
                if (!isset($_POST['email']) || !isset($_POST['password'])) {
                    $_SESSION['signError'] = "Tous les champs sont requis";
                    header("Location: /login");
                    exit;
                }

                $email = trim($_POST['email']);
                $password = $_POST['password'];

                // Validation basique de l'email
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['signError'] = "Adresse email invalide";
                    header("Location: /login");
                    exit;
                }

                $user = $this->userRepo->findByEmail($email);

                if(!$user) {
                    $_SESSION['signError'] = "Adresse Mail ou Mot de passe incorrect";
                    header("Location: /login");
                    exit;
                }

                if(!password_verify($password, $user->getPassword())) {
                    $_SESSION['signError'] = "Adresse Mail ou Mot de passe incorrect";
                    header("Location: /login");
                    exit;
                }

                $_SESSION["authenticated"] = true;
                $_SESSION["user_id"] = $user->getId();
                $_SESSION["username"] = $user->getUsername();
                header("Location: /tasks");

                exit;
            } else {
                require_once __DIR__ ."/../../views/auth/login.php";
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