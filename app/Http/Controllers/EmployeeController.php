<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDept;
use Illuminate\Http\Request;
use App\Models\EmployeePosition;
use App\DataTables\EmployeesDataTable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('departments', 'positions')->get();

        // dd($employees);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depts = EmployeeDept::all();
        $positions = EmployeePosition::all();

        return view('employees.create', compact('depts', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nid' => 'required',
            'type' => 'required',
            'status' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'employee_dept_id' => 'required|integer',
            'employee_position_id' => 'required|integer'
        ]);

        Employee::create($request->all());
        // return dd($employee);
        return to_route('employees.index')->with(['success', 'Employee successfully created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee)
    {
        $employees = Employee::find($employee);
        $depts = EmployeeDept::all();
        $positions = EmployeePosition::all();
        
        return view('employees.edit', compact('employees', 'depts', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'nid' => 'required|max:16',
            'type' => 'required',
            'status' => 'required',
            'employee_dept_id' => 'required',
            'employee_position_id' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:16',
        ]);

        $employees = Employee::find($employee);
        $employees->update($request->all());

        return to_route('employees.index')->with(['success', 'Employee successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee)
    {
        $employees = Employee::find($employee);
        $employees->delete();

        return to_route('employees.index');
    }
}
