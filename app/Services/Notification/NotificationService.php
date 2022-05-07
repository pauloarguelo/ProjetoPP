<?php

namespace App\Services\Notification;

use App\Jobs\SendNotificationEmailJob;
use App\Services\BaseService;


class NotificationService extends BaseService
{   
    /**
     * Notify the user about the transaction.
     * @param int $user_id
     * @param string $title
     * @param string $message
     */
    public function notifyUser($user_id, $title, $text){

        $notification = $this->repository->create([
            'user_id' => $user_id,
            'title' => $title,
            'text' => $text
        ]);

        dispatch(new SendNotificationEmailJob($notification['id']));

        return $notification;
    }

    /**
     * Mark the notification as delivered.
     * @param int $notification_id
     */
    public function markNotificationAsDelivered($notification_id){
        $notification = $this->repository->findByParam('id', $notification_id);
        $notification['is_delivered'] = true;
        return $this->repository->update($notification_id, $notification);
    }
    

    
}