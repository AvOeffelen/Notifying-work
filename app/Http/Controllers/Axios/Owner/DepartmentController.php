<?php

namespace App\Http\Controllers\Axios\Owner;

use App\Http\Controllers\Controller;
use App\Model\Company;
use App\Model\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class DepartmentController extends Controller
{

    public function getDepartments()
    {
        $departments = Department::where('company_id',Auth::user()->company_id)->get();

        return $departments->toJson();
    }

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

    public function massDeleteDepartment(Request $request,Company $company)
    {
        $idArray = explode(",",$request->Ids);

        $departments = Department::whereIn('id',$idArray)->get();

        foreach($departments as $index => $department){
            try{
                $department->User()->detach();
                $department->delete();
            } catch (\Exception $e){
                $e->getMessage();
            }
        }

        return $this->getAllDepartmentsForCompany($company);
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

        if(count($request['employees']) >= 1){
            foreach ($request['employees'] as $index => $user){
                $department->User()->attach($user['id']);
            }
        } else {
            $department->User()->attach($request['manager']['id']);
        }

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

        //Detaching old manager from department. This can be changed later.
        $department->User()->detach($department->manager_user_id);


        $department->name = $request->name;
        $department->manager_user_id = $request['manager']['id'];
        $department->update();

        $departmentEmployees = $department->User()->get();
        if(!$departmentEmployees->contains('id',$request['manager']['id'])){
            $department->User()->attach($request['manager']['id']);
        }

        return $department->toJson();
    }

    public function detachEmployeeFromDepartment(Request $request,Company $company, Department $department)
    {
        $ids = $request->employees;

//        $users = User::findMany($ids);

        $department->User()->detach($ids);
    }

    public function attachEmployeesToDepartment(Request $request,Company $company,Department $department)
    {
        foreach($request->params['selectedEmployees'] as $index => $newEmployee){
            $department->User()->attach($newEmployee['id']);
        }

        return $department->toJson();
    }
}
