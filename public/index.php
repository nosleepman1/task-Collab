<?php
session_start();

$requestUri = $_SERVER['REQUEST_URI'];

$path = parse_url($requestUri, PHP_URL_PATH);

$path = trim($path, '/');


//initialisation env ...avoid appel a chaque appel de database instance
require_once '../config/config.php';




    use App\Controllers\AuthController;
    use App\Controllers\MainController;
    use App\Controllers\TaskController;

    
    $controller = new MainController();
    $AuthController = new AuthController();
    $TaskController = new TaskController();

    

    switch($path) {
            case '':
            case 'home':
                $controller->home();
                break;
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $AuthController->login();
                } else {
                    $AuthController->showLoginForm();
                }
                break;
            case 'register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $AuthController->register();
                } else {
                    $AuthController->showRegisterForm();
                }
                break;

            case 'logout':
                $AuthController->logout();
                break;

            case 'tasks':     
                $TaskController->showTasks();
                break;    
            case 'create':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $TaskController->createTask();
                } else {
                    $TaskController->showTaskForm();
                }
            

            default:
                $controller->notFound();
                break;
        }