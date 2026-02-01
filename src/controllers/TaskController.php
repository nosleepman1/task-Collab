<?php

    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Utils\Auth;
    use App\Utils\Session;
    use App\models\Task;
    use App\repositories\TasksRepository;
    use App\repositories\ProjectRepository;
    use App\repositories\UserRepository;


    //send json


    class TaskController extends BaseController {

        private TasksRepository $taskRepository;
        private ProjectRepository $projectRepository;
        private UserRepository $userRepository;



        public function __construct()
        {
            $this->taskRepository = new TasksRepository();
            $this->projectRepository = new ProjectRepository();
            $this->userRepository = new UserRepository();
        }


       public function index() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            $tasks = $this->taskRepository->myTasks(Auth::user()->getId());
            $this->view('tasks/index.php', ['tasks' => $tasks]);
       }


       public function showCreateTaskForm(){
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            if(Auth::user()->getRole() != 'owner') {
                Session::flash('Vous n\'avez pas les droits pour créer une tâche', 'error');
                $this->redirect('/tasks');
                return;
            }

            $myProjects = $this->projectRepository->myProjects();
            $avalaibleMembers = $this->userRepository->showAvalaibleMembers();

            $this->view('tasks/create.php', [
                'myProjects' => $myProjects,
                'avalaibleMembers' => $avalaibleMembers
            ]);
        }




        public function assignTask(){
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            if(Auth::user()->getRole() != 'owner') {
                Session::flash('Vous n\'avez pas les droits pour créer une tâche', 'error');
                $this->redirect('/tasks');
                return;
            }

            $user_id = $_POST['user_id'];
            $project_id = $_POST['project_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $priority = $_POST['priority'];
            $deadline = $_POST['deadline'];

            $task = new Task($title, $description, $status, $priority, $deadline);
            $task->setUserId($user_id);
            $task->setProjectId($project_id);

            $task = $this->taskRepository->create($task);

            if ($task) {
                Session::flash('Tâche créée avec succès', 'success');
                $this->redirect('/tasks');
                return;
            } else {
                Session::flash('Erreur lors de la création de la tâche', 'error');
                $this->redirect('/tasks/create');
                return;
            }

        }

            






    }
        

    