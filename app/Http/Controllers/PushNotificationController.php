<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    public function index()
    {
        if(auth()->user()->isOwner()){
            return response()->view('notification.push.company_owner.index');
        }

        //todo:: create regular index and return that here.
        return response()->view('company.index');
    }
}
