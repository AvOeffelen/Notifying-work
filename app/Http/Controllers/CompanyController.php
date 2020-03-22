<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {

        if(auth()->user()->isOwner()){
            return response()->view('company.company_owner.index');
        }

        return response()->view('company.index');
    }

}
