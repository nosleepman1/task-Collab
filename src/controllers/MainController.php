<?php

require_once __DIR__ . '/../repositories/TasksRepository.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

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