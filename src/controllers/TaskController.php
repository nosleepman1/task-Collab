<?php

    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Utils\Auth;
    use App\Utils\Session;
    use App\models\Task;
    use App\repositories\TasksRepository;

    //send json


    class TaskController extends BaseController {

        private TasksRepository $taskRepository;

        public function __construct()
        {
            $this->taskRepository = new TasksRepository();
        }


        public function showTasks(){
            if(!Auth::check()){
                Session::flash('Vous devez être connecté pour accéder à cette page', 'error');
                $this->redirect('/login');
                
                return;
            }


        }
        

    }