<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Utils\Auth;
    use App\Utils\Session;
    use App\repositories\ProjectRepository;
    use App\repositories\TasksRepository;
    use App\models\Project;
    



    class ProjectController extends BaseController {


        private TasksRepository $taskRepository;
        private ProjectRepository $projectRepository;



        public function __construct()
        {
            $this->taskRepository = new TasksRepository();
            $this->projectRepository = new ProjectRepository();
        }


        public function index() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            $projects = $this->projectRepository->myProjects();
            $projectTasks = [];

            foreach ($projects as $project) {
                $projectTasks[$project->getId()] = $this->taskRepository->ProjectTasks($project->getId());
            }

            $this->view('projects/index.php', [
                'projects' => $projects,
                'projectTasks' => $projectTasks
            ]);
        
        }

        public function create(){
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            if(Auth::user()->getRole() != 'owner') {
                Session::flash('Vous n\'avez pas les droits pour créer un projet', 'error');
                $this->redirect('/projects');
                return;
            }


            $title = $_POST['title'];
            $description = $_POST['description'];

            if (!isset($title) || !isset($description)) {
                Session::flash('Veuillez remplir tous les champs', 'error');
                $this->redirect('/projects');
                return;
            }

            $project = new Project($title, $description);
            $project->setOwner(Auth::user());

            $project = $this->projectRepository->save($project);

            if ($project) {
                Session::flash('Projet créé avec succès', 'success');
                $this->redirect('/projects');
                return;
            }

        }

        public function showCreateForm(){
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            if(Auth::user()->getRole() != 'owner') {
                Session::flash('Vous n\'avez pas les droits pour créer un projet', 'error');
                $this->redirect('/projects');
                return;
            }

            $this->view('projects/create.php');
        }
        
    }