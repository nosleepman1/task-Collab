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

            if ($this->userRepository->findByEmail($email)) {
                Session::flash('L\'email est déjà utilisé', 'error');
                $this->redirect('/register');
                return;
            }

            $user = new User($firstname, $lastname, $email, );
            $user->setPassword($password); // Hash the password

            $user = $this->userRepository->create($user);

            if (!$user) {
                Session::flash('Erreur lors de la création de l\'utilisateur', 'error');
                $this->redirect('/register');
                return;
            }

            Session::flash('Inscription reussie veuillez vous connectez à votre nouveau compte', 'success');
            $this->redirect('/login');
            return;
            
            
        }

        public function showRegisterForm(){
            if (Auth::check()) {
                $this->redirect('/');
                return;
            }

            $this->view('auth/register.php');
        }


        public function login(){
            if (Auth::check()) {
                $this->redirect('/');
                return;
            }

            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                Session::flash('Veuillez remplir tous les champs', 'error');
                $this->redirect('/login');
                return;
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!Auth::attemp($email, $password)) {
                Session::flash('Email ou mot de passe incorrect', 'error');
                $this->redirect('/login');
                return;
            }

            $this->redirect('/');
            Session::flash("Bienvenue" . Auth::user()->getFullname() , 'success');
            return;
        }


        public function showLoginForm(){
            if (Auth::check()) {
                $this->redirect('/');
                return;
            }
            $this->view('auth/login.php');
        }


        public function logout(){
            Auth::logout();
            $this->redirect('/login');
            Session::flash('Vous avez été déconnecté', 'success');
            return;
        }

    }