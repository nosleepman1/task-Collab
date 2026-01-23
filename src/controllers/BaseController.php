<?php 

    namespace App\Controllers;

    use Exception;


    abstract class BaseController {

        
       

        public function redirect(string $url)
        {
            header('Location: ' . $url);
            exit;
        }

        public function view(string $view, array $data = []){
            $viewPath = VIEW_PATH . '/' . $view;

            if (!file_exists($viewPath)) {
                throw new Exception("Vue introuvable");
            }

            extract($data);

            require $viewPath;
        }


    }
   