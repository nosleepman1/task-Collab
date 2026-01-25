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


       public function index() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            $tasks = $this->taskRepository->myTasks(Auth::user()->getId());
            $this->view('tasks/index.php', $tasks);
       }


       public function create() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $priority = $_POST['priority'];
            $deadline = $_POST['deadline'];

            if (!isset($title) || !isset($description) || !isset($status) || !isset($priority)) {
                Session::flash('Veuillez remplir tous les champs', 'error');
                $this->redirect('/tasks');
                return;
            }

            $task = new Task($title, $description, $status, $priority, $deadline);
            $task->setUserId(Auth::user()->getId());

            $task = $this->taskRepository->create($task);

            if(!$task) {
                Session::flash('Erreur lors de la création de la tâche', 'error');
                $this->redirect('/tasks');
                return;
            }

            Session::flash('Tâche créée avec succès', 'success');
            $this->redirect('/tasks');
            return;
       }







    }
        

    