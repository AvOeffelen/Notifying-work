<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetStartedController extends Controller
{
    public function index()
    {

        return response()->view('get-started.index');
    }
}
