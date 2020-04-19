<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        if(auth()->user()->isOwner()){
            return response()->view('employee.company_owner.index');
        }

        //todo:: create regular index and return that here.
        return response()->view('company.index');
    }
}
