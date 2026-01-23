<?php 
    
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\models\User;
    use App\repositories\UserRepository;
    use App\Utils\Session;
    use App\Utils\Auth;
  
  
    //session_start();
    class AuthController extends BaseController {
        
        private UserRepository $userRepository;


        public function __construct()
        {
            $this->userRepository = new UserRepository();
        }


        public function register(){
            
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirmation = $_POST['password_confirmation'];

            if ($this->userRepository->findByEmail($email)) {
                Session::flash('L\'email est déjà utilisé', 'error');
                header('Location: /register');
                return;
            }

            $user = new User($firstname, $lastname, $email, $password);

            $user = $this->userRepository->create($user);

            if (!$user) {
                Session::flash('Erreur lors de la création de l\'utilisateur', 'error');
                header('Location: /register');
                return;
            }

            Session::flash('Utilisateur créé avec succès', 'success');
            header('Location: /login');
            return;
            
            
        }

        public function showRegisterForm(){
            if (Auth::check()) {
                header('Location: /');
                return;
            }

            view_path('auth/register.php');
        }


        public function login(){
            if (Auth::check()) {
                header('Location: /');
                return;
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!Auth::attemp($email, $password)) {
                Session::flash('Email ou mot de passe incorrect', 'error');
                header('Location: /login');
                return;
            }

            header('Location: /');
            Session::flash("Bienvenue {} ", 'success');
            return;
        }


        public function showLoginForm(){
            if (Auth::check()) {
                header('Location: /');
                return;
            }

            view_path('auth/login.php');
        }



    }