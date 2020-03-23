<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Department;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

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
            'name' => 'required|min:3|max:15',
            'manager' => 'required'
        ],$messages);

        $department = $this->store($request->toArray());

        $department->User()->attach($request['manager']['id']);

       $newDepartment = Department::with('Manager')->With('User')->withCount('User')->findOrFail($department->id);

        return $newDepartment->toJson();
    }

    private function store(Array $data){
        $department = Department::create([
            'name' => $data['name'],
            'company_id' => auth()->user()->Company->id,
            'manager_user_id' => $data['manager']['id']
        ]);

        return $department;
    }

    public function edit(Request $request,Department $department)
    {

        $messages = [
            'manager.required' => 'Please select a manager.'
        ];
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:15',
            'manager' => 'required'
        ],$messages);

        $department->name = $request->name;
        $department->manager_user_id = $request['manager']['id'];
        $department->update();

        return $department->toJson();
    }

    private function storeUserToDepartment($user,$department){

    }
}
