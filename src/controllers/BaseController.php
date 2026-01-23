<?php 

    namespace App\Controllers;


    abstract class BaseController {

        
        public function notFound()
        {
            require_once __DIR__ . '/../../views/pages/404.php';
        }

        public function home()
        {
            require_once __DIR__ . '/../../views/pages/accueil.php';
        }

        public function redirect(string $url)
        {
            header('Location: ' . $url);
            return;
        }

        public function view(string $view){
            require_once __DIR__ . '/../../views/' . $view;
        }


    }
   