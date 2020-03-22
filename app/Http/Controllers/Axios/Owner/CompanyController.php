<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function update(Request $request,Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:1|max:15',
            'email' => 'required|email|unique:company,email,'.$company->id,
            'address' => 'required|min:1|max:25',
            'number' => 'required|min:1|max:5',
            'zip' => 'required|min:6|max:6',
            'state' => 'required|min:1|max:25',
            'city' => 'required|min:1|max:25',
            'country' => 'required|min:1|max:25',
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->number = $request->number;
        $company->zip = $request->zip;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->country = $request->country;
        $company->update();

        return $company->toJson();
    }


    public function getAllEmployees(Company $company)
    {
        $users = DB::table('users')->where('company_id',$company->id)->select('name','id')->get();

        return $users->toJson();
    }
}
