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
            $tasks = $this->taskRepository->myTasks(Auth::user()->getId());
            $this->view('tasks/tasks.php', array('tasks' => $tasks));
        }

        public function createTask(){
            
        if(!Auth::check()){
                Session::flash('Vous devez être connecté pour accéder à cette page', 'error');
                $this->redirect('/login');
                return;
            }

            $title = $_POST['title'];
            $description = $_POST['description'];

            if (empty($title)) {
                Session::flash('Titre requis', 'error');
                $this->redirect('/create');
            }

            $task = new Task($title, $description);
            $task->setUserId(Auth::user()->getId());
            $task = $this->taskRepository->create($task);

            if ($task) {
                Session::flash('Tâche créée avec succès', 'success');
                $this->redirect('/tasks');
            } else {
                Session::flash('Creation de tache echouée', 'error');
                $this->redirect('/create');
            }
        }

        public function showTaskForm(){

            if(!Auth::check()){
                Session::flash('Vous devez être connecté pour accéder à cette page', 'error');
                $this->redirect('/login');
                return;
            }

            $this->view('tasks/create.php');
        }

        public function deleteTask(){
            if(!Auth::check()){
                Session::flash('Vous devez être connecté pour accéder à cette page', 'error');
                $this->redirect('/login');
                return;
            }

            $idTask = $_POST['id'];

            $this->taskRepository->delete($idTask);

            Session::flash('Tâche supprimée avec succès', 'success');
            $this->redirect('/tasks');
        }

        public function updateTask(){
            if(!Auth::check()){
                Session::flash('Vous devez être connecté pour accéder à cette page', 'error');
                $this->redirect('/login');
                return;
            }

            $idTask = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];


            $task = new Task($title, $description);

            $task->setId($idTask);
            $task = $this->taskRepository->create($task);
        }
    }
        

    