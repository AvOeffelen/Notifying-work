<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Helper\NotificationSender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{

    public function handleNotification(Request $request)
    {

        $notificationHelper = new NotificationSender();
        $notificationHelper->sendNotification($request);

        return redirect()->back();
    }
}
