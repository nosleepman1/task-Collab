<?php 
    namespace App\Utils;

    use App\models\User;
    use App\repositories\UserRepository;
    class Auth {

        private static ?User $currentUser = null;

        public static function check(){
            Session::start();
            return Session::has('user_id');
        }
        
        public static function guest(){
            return !Auth::check();
        }

        public static function login(User $user){
            Session::start();
            Session::set('user_id', $user->getId());

            self::$currentUser = $user;
        }

        public static function logout(){
            Session::destroy();
            self::$currentUser = null;
        }

        public static function id() : ?int{
            if(!self::check())
                return null;
            return Session::get('user_id');
        }

        public static function user() : ?User{
           if(self::$currentUser !== null)
                return self::$currentUser;

           $userId = self::id();
            if(!$userId)
                return null;

            $userRepo = new UserRepository();
            self::$currentUser = $userRepo->find($userId);
            return self::$currentUser;
        
        }

        public static function attemp(string $email, string $password){
            $userRepo = new UserRepository();
            $user = $userRepo->findByEmail($email);

            /**
             * @param   $user
             * @method User verifyPassword()
             */

            if(!$user || !$user->verifyPassword($password) || !$user->isActive())
                return false;

           

            self::login($user);
            return true; 
        }
    }