<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function getEmployees()
    {
        $employees = User::where('company_id',Auth::user()->company_id)->paginate(10);

        return response()->json($employees);
    }

    public function getUnfilteredEmployees()
    {
        $employees = User::where('company_id',Auth::user()->company_id)->get();

        return response()->json($employees);
    }
}
