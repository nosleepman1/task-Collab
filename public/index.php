<?php
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);

$path  = str_replace($scriptName, '', $requestUri);
$path = trim($path, '/');

$path = strtok($path, '?');

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


    require_once '../src/controllers/MainController.php';
    $controller = new MainController();

    switch($path) {
            case '':
            case 'accueil':
                $controller->accueil();
                break;
            case 'login':
                $controller->about();
                break;
            case 'register':
                $controller->contact();
                break;
            default:
                $controller->notFound();
                break;
        }