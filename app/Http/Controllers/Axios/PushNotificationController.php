<?php

namespace App\Http\Controllers\Axios;

use App\Helper\NotificationSender;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function getNotificationsForUser()
    {
        return auth()->user()->notifications->take(10);
    }

    public function markNotificationAsRead($notificationId)
    {
        $notifications = auth()->user()->notifications;
        foreach($notifications as $index => $notification){
            if($notification->id === $notificationId){
                $notification->markAsRead();
                return $notification;
            }
        }
    }

    public function handleNotification(Request $request)
    {
        $notificationHelper = new NotificationSender();
        $notificationHelper->sendNotification($request);

        return redirect()->back();
    }
}
