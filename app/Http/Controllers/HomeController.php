<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isOwner()){
            return response()->view('dashboard.company_owner.index');
        } elseif (auth()->user()->isDefault()){
            return response()->view('dashboard.default.index');
        }
        return view('home');
    }
}
