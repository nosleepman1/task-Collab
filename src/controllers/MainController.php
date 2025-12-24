<?php

class MainController
{
    public function accueil()
    {
        require_once __DIR__ . '/../../views/pages/accueil.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function contact()
    {
        require_once __DIR__ . '/../../views/pages/contact.php';
    }

    public function notFound()
    {
        require_once __DIR__ . '/../../views/pages/404.php';
    }
}