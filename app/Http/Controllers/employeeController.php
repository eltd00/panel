<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function showEmployee(){
        $employees = Employee::select("id", "name", "age", "Country")->get();
        return view("employee.display", compact('employees'));
    }
    public function addEmployee(){
            return view("employee.add");
    }
    public function store(employeeRequest $request){
        Employee::create($request->validated());
        return redirect()->back()->with(["success"=>"Saved successfully"]);
    }
    public function edit($employee_id){

        $employee=Employee::find($employee_id);
        if (!$employee)
        {
            return redirect()->back();
        }
        $employee=Employee::select('id','name','age','country')->find($employee_id);
        return view('employee.edit',compact('employee'));
    }
    public function UpdateEmployee(employeeRequest $request ,$employee_id){
        $employee=Employee::find($employee_id);
        if(!$employee)
        {
            return redirect()->back();
        }
        $employee->update($request->all());
        return redirect()->back()->with(['success'=>'edit was successful']);
    }
    public function DeleteEmployee($employee_id)
    {
        $employee = Employee::find($employee_id);
        if (!$employee) {
            return redirect()->back()->with(['error' => 'error']);;
        }
        $employee->where("id",$employee_id)->delete();
        return redirect()->back()->with(['success' => 'delete was successful']);
    }
}
