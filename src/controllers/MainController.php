<?php

class MainController
{
    public function accueil()
    {
        require_once __DIR__ . '/../../views/pages/accueil.php';
    }

    public function login()
    {
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function tasks()
    {
        if (!isset($_SESSION["authenticated"])) {
            $this->notFound();
            return;
        }
        require_once __DIR__ . '/../../views/tasks/tasks.php';
    }

    public function notFound()
    {
        require_once __DIR__ . '/../../views/pages/404.php';
    }
}