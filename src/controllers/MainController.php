<?php

namespace App\Controllers;

class MainController
{
    public function home()
    {
        require_once __DIR__ . '/../../views/pages/accueil.php';
    }


    public function notFound()
    {
        require_once __DIR__ . '/../../views/pages/404.php';
    }
}