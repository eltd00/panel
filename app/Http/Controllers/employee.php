<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class employee extends Controller
{
    public function showEmployee(){
        $employees = \App\Models\Employee::select("id", "name", "age", "Country")->get();
        return view("employee.display", compact('employees'));
    }
    public function addEmployee(){
            return view("employee.add");
    }
    public function store(employeeRequest $request){
        \App\Models\Employee::create([
           'name'=>$request->name,
           'age'=>$request->age,
           'country'=>$request->country
        ]);
        return redirect()->back()->with(["success"=>"Saved successfully"]);

    }
    public function edit($employee_id){

        $employee=\App\Models\Employee::find($employee_id);
        if (!$employee)
        {
            return redirect()->back();
        }
        $employee=\App\Models\Employee::select('id','name','age','country')->find($employee_id);
        return view('employee.edit',compact('employee'));
        return $employee_id;
    }
    public function UpdateEmployee(employeeRequest $request ,$employee_id){
        $employee=\App\Models\Employee::find($employee_id);
        if(!$employee)
        {
            return redirect()->back();
        }
        $employee->update($request->all());
        return redirect()->back()->with(['success'=>'edit was successful']);
    }
    public function DeleteEmployee($employee_id)
    {
        $employee = \App\Models\Employee::find($employee_id);
        if (!$employee) {
            return redirect()->back()->with(['error' => 'error']);;
        }
        $employee->where("id",$employee_id)->delete();
        return redirect()->back()->with(['success' => 'delete was successful']);
    }
}
