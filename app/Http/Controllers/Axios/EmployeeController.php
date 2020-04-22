<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function getEmployees()
    {
        $employees = User::where('company_id',Auth::user()->company_id)->get();

        return response()->json($employees);
    }
}
