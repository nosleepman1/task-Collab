<?php
session_start();

$requestUri = $_SERVER['REQUEST_URI'];

$path = parse_url($requestUri, PHP_URL_PATH);

$path = trim($path, '/');


//initialisation env ...avoid appel a chaque appel de database instance
require_once '../config/config.php';




    require_once '../src/controllers/MainController.php';
    require_once '../src/controllers/UserController.php';
    require_once '../src/controllers/TaskController.php';
    
    $controller = new MainController();
    $UserController = new UserController();
    $TaskController = new TaskController();

    

    switch($path) {
            case '':
            case 'home':
                $controller->home();
                break;
            case 'login':
                $UserController->login();
                break;
            case 'register':
                $UserController->register();
                break;

            case 'tasks':
                $TaskController->create();
                break;
            default:
                $controller->notFound();
                break;
        }