<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\employees\Employee;
use App\Http\Model\companies\Company;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $employees = Employee::all();
        $data['employees'] = $employees;
        return view('employees.list', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {   
        $data = [];
        // print_r($request->all()); exit;
        if(!empty($request->all())){
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:employee',
                'phone' => 'required|regex:/[0-9]{10}/|unique:employee',
                'company' => 'required|min:1',
            ]);
    
            $employee = new Employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->companyid = $request->company;
    
            $employee->save();

            return redirect('employees');
        }
        $data['company_data'] = Company::all();
        return view('employees.add', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {   
        $data = [];
        $segments = request()->segments();
        $id = $segments[2];
        $employee = Employee::findOrFail($id);
        if(!empty($request->all())){
            $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/[0-9]{10}/',
                'company' => 'required',
            ]);
    
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->companyid = $request->company;
    
            $employee->save();
            return redirect('employees');
        }
        $data['company_data'] = Company::all();
        $data['employee_data'] = $employee;
        return view('employees.edit', $data);
    }

    /**
     * Show the delete employee.
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        if(!empty($request->toDelete) && $request->toDelete == 1){
            $record = Employee::findOrFail($id);
            $record->delete();
        }
        return redirect('employees');
    }
}
