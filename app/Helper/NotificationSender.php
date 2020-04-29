<?php


namespace App\Helper;


use App\Model\Department;
use App\Notifications\VariablePush;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationSender
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function sendNotification(Request $request)
    {
        NotificationSender::validate($request);

        $notification = $request['notification'];
        $ids = array();
        foreach ($request['to'] as $index => $item) {
            array_push($ids, $item['id']);
        }

        if ($request['receiverType'] == 'department') {
           return NotificationSender::sendNotificationToDepartments($notification, $ids);
        } elseif ($request['receiverType'] == 'company') {
            return NotificationSender::sendNotificationToCompany($notification);
        } elseif($request['receiverType'] == 'employees'){
            return NotificationSender::sendNotificationToEmployees($notification,$ids);
        }
    }

    protected static function validate(Request $request){
        $messages = [
            'notification.message.required' => 'The notification message is required.',
            'notification.message.min' => 'The notification message has to contain more than 3 character.',
            'notification.message.max' => 'The notification message can not contain more than 128 characters',
            'notification.title.required' => 'The notification title is required.',
            'notification.title.min' => 'The notification title has to contain more than 3 character.',
            'notification.title.max' => 'The notification title can not contain more than 128 characters',
        ];

        return $request->validate([
            'notification.message' => 'required|min:3|max:128',
            'notification.title' => 'required|min:3|max:128'
        ], $messages);
    }

    protected static function sendNotificationToCompany(array $notification)
    {
        $employees = User::all()->where('company_id', Auth::user()->id);

        try {
            Notification::send($employees, new VariablePush($notification));
        } catch (\Exception $e) {
            $e->getMessage();
            $e->getLine();
        }

        return redirect()->back();
    }

    protected static function sendNotificationToDepartments(array $notification, array $ids)
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

    protected static function sendNotificationToEmployees(array $notification, array $ids)
    {

        $employees = User::whereIn('id',$ids)->get();
        $when = now();
        foreach($employees as $employee){
            $employee->notify(new VariablePush($notification));
        }
        return redirect()->back();
//        try {
//            Notification::send($employees, new VariablePush($notification));
//        } catch (\Exception $e) {
//            $e->getMessage();
//            $e->getLine();
//        }
    }
}
