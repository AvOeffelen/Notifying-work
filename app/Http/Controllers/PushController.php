<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Notifications\VariablePush;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushController extends Controller
{
    /**
     * Store the PushSubscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);

        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];

        if(Auth::user()){
            $user = Auth::user();
            $user->updatePushSubscription($endpoint, $key, $token);
        } else {
            $guest = Guest::firstOrCreate([
                'endpoint' => $endpoint
            ]);

            $guest->updatePushSubscription($endpoint, $key, $token);
        }



        return response()->json(['success' => true],200);
    }

    /**
     * Send Push Notifications to all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function push(){
        try{
            $user = User::find(1);
            $electedUser = $user->first();

            $text = "New test!!!";
            Notification::send($user, new VariablePush($text));

            return redirect()->back();
        }catch (\Exception $e){
            $e->getMessage();
            $e->getLine();
        }
    }


    /**
     * Send Push Notifications to all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function pushToGuest(){
        try{
            $user = User::find(1);
            $electedUser = $user->first();

            $text = "Dont forget to do this";
            Notification::send(Guest::all(), new VariablePush($text));

            return redirect()->back();
        }catch (\Exception $e){
            $e->getMessage();
            $e->getLine();
        }
    }
}
