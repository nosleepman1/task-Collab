<?php 

    namespace App\Repositories;

use App\Models\BaseEntity;
use App\models\Notification;
use App\Utils\Auth;
use DateTime;
use PDO;
use PDOException;

    class NotificationRepository extends BaseRepository {

        protected string $tableName = 'notifications';

        public function hydrate(array $data): Notification
        {
            $notification = new Notification(Auth::user(), $data['message'], $data['is_read']);
            $notification->setId((int)$data['id']);
            $notification->setCreatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['createdAt']));
            $notification->setUpdatedAt(DateTime::createFromFormat('Y-m-d H:i:s', $data['updatedAt']));
            return $notification;
        }


        public function create(Notification $notification) {

            if (!$notification->getId()) {
                try {
                    $sql = "INSERT INTO {$this->tableName} (user_id, message, is_read, createdAt, updatedAt) VALUES (:user_id, :message, :is_read, NOW(), NOW())";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute([
                        'user_id' => $notification->getUser()->getId(),
                        'message' => $notification->getMessage(),
                        'is_read' => $notification->getIsRead()
                    ]);

                    if ($result) {
                        return $notification;
                    }
                    return null;
                } catch (PDOException $e) {
                    $this->logError($e);
                    return null;
                }
            } else {
                try {
                    $sql = "UPDATE {$this->tableName} SET user_id = :user_id, message = :message, is_read = :is_read, updatedAt = NOW() WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $result = $stmt->execute([
                        'user_id' => $notification->getUser()->getId(),
                        'message' => $notification->getMessage(),
                        'is_read' => $notification->getIsRead(),
                        'id' => $notification->getId()
                    ]);

                    if ($result) {
                        return $notification;
                    }
                    return null;
                } catch (PDOException $e) {
                    $this->logError($e);
                    return null;
                }
            }
        }


        public function findNotifications() {
            try {
                $sql = "SELECT * FROM {$this->tableName} WHERE user_id = :user_id ORDER BY createdAt DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['user_id' => Auth::user()->getId()]);
                $result = $stmt->fetchAll();
                return $this->hydrateMultiple($result);
            } catch (PDOException $e) {
                $this->logError($e);
            }
        }
    }