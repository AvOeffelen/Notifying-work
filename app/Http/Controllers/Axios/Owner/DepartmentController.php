<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getAllDepartmentsForCompany(Company $company)
    {

        $departments = Department::where('company_id',$company->id)->with('Manager')->With('User')->withCount('User')->get();

        return $departments->toJson();
    }

    public function delete(Department $department)
    {
        try{
            $department->User()->detach();
            $department->delete();
        } catch (\Exception $e){
            $e->getMessage();
        }

        return;
    }

    public function create(Request $request)
    {


        $messages = [
            'manager.required' => 'Please select a manager.'
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:1|max:15',
            'manager' => 'required'
        ],$messages);


        return;
    }
}
