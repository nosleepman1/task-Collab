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
use App\Repositories\NotificationRepository;

    class NotificationController extends BaseController {

        private NotificationRepository $notificationRepository;
        private UserRepository $userRepository;


        public function __construct()
        {
            $this->notificationRepository = new NotificationRepository();
            $this->userRepository = new UserRepository();
        }


        public function index() {
            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }


            $notifications = $this->notificationRepository->findNotifications();

            $this->view('notifications/index.php', [
                'notifications' => $notifications
            ]);
        
        }

        public function showNotification(int $id){
            $notification = $this->notificationRepository->findNotification($id);
            $this->notificationRepository->create($notification);
            $this->view('notifications/show.php', [
                'notification' => $notification
            ]);
        }


        public function markAsRead(int $id) {

            if (!Auth::check()) {
                $this->redirect('/login');
                return;
            }

            $this->notificationRepository->markAsRead($id);
            $this->redirect('/notifications/index.php');
            return;
        }

    }