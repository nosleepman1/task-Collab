<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Utils\Auth;
    use App\Utils\Session;
    use App\models\Task;
    use App\repositories\TasksRepository;
    use App\models\Project;
    use App\repositories\ProjectRepository;
    use App\repositories\ProjectMemberRepository;
    use App\models\ProjectMember;
    use App\repositories\UserRepository;
    use App\models\User;

    
    class NotificationController extends BaseController {

        private UserRepository $userRepository;
        private ProjectRepository $projectRepository;
        private ProjectMemberRepository $projectMemberRepository;
        private TasksRepository $taskRepository;

        public function __construct()
        {
            $this->userRepository = new UserRepository();
            $this->projectRepository = new ProjectRepository();
            $this->projectMemberRepository = new ProjectMemberRepository();
            $this->taskRepository = new TasksRepository();
        }


        public function index() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            

    }