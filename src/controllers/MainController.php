<?php 

    namespace App\Controllers;
    use App\Controllers\BaseController;
    


    class MainController extends BaseController {

        public function __construct() {
        }

         public function notFound()
        {
            $this->view('pages/404.php');
        }

        public function home()
        {
            $this->view('pages/accueil.php');
        }
    }