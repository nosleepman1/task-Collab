<?php
$requestUri = $_SERVER['REQUEST_URI'];

// On prend uniquement le chemin, sans les query params
$path = parse_url($requestUri, PHP_URL_PATH);

// Supprime les / au début et à la fin
$path = trim($path, '/');


//initialisation env ...avoid appel a chaque appel de database instance
require __DIR__ .'/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv  = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



    require_once '../src/controllers/MainController.php';
    require_once '../src/controllers/UserController.php';
    
    $controller = new MainController();
    $UserController = new UserController();

    

    switch($path) {
            case '':
            case 'accueil':
                $controller->accueil();
                break;
            case 'login':
                $controller->about();
                break;
            case 'register':
                $UserController->register();
                break;
            default:
                $controller->notFound();
                break;
        }