<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Notifications\VariablePush;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PushNotificationController extends Controller
{
    /**
     * Send Push Notifications to all users.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        $messages = [
            'notification.message.required' => 'The notification message is required.',
            'notification.message.min' => 'The notification message has to contain more than 3 character.',
            'notification.message.max' => 'The notification message can not contain more than 128 characters',
            'notification.title.required' => 'The notification title is required.',
            'notification.title.min' => 'The notification title has to contain more than 3 character.',
            'notification.title.max' => 'The notification title can not contain more than 128 characters',
        ];
        $validatedData = $request->validate([
            'notification.message' => 'required|min:3|max:128',
            'notification.title' => 'required|min:3|max:128'
        ], $messages);

        $notification = $request['notification'];

        $ids = array();
        foreach ($request['to'] as $index => $item) {
            array_push($ids, $item['id']);
        }


        if ($request['selectedReciever'] == 'department') {
            $this->sendNotificationToDepartments($notification, $ids);
        } elseif ($request['selectedReciever'] == 'company') {
            $this->sendNotificationToCompany($notification);
        } elseif($request['selectedReciever'] == 'employees'){
            $this->sendNotificationToEmployees($notification,$ids);
        }
    }

    private function sendNotificationToCompany(array $notification)
    {
        $employees = User::all()->where('company_id', Auth::user()->id);

        try {
            Notification::send($employees, new VariablePush($notification));


            return redirect()->back();
        } catch (\Exception $e) {
            $e->getMessage();
            $e->getLine();
        }
    }

    private function sendNotificationToDepartments(array $notification, array $ids)
    {
        $departments = Department::with('user')->whereIn('id', $ids)->get();

        foreach ($departments as $department) {
            try {
                Notification::send($department->user, new VariablePush($notification));
            } catch (\Exception $e) {
                $e->getMessage();
                $e->getLine();
            }
        }

        return redirect()->back();
    }

    private function sendNotificationToEmployees(array $notification, array $ids)
    {
        $employees = User::whereIn('id',$ids)->get();
        try {
            Notification::send($employees, new VariablePush($notification));
        } catch (\Exception $e) {
            $e->getMessage();
            $e->getLine();
        }
    }
}
