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
        $employees = Employee::with('departments', 'positions')->orderByDesc('updated_at')->get();

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
        $validation = $this->validate($request, [
            'name' => 'required',
            'nid' => 'required',
            'type' => 'required',
            'status' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'employee_dept_id' => 'required|integer',
            'employee_position_id' => 'required|integer'
        ]);

        Employee::create($validation);

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
    public function edit(Employee $employee)
    {
        $depts = EmployeeDept::all();
        $positions = EmployeePosition::all();

        return view('employees.edit', compact('employee', 'depts', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validation = $this->validate($request, [
            'name' => 'required',
            'nid' => 'required',
            'type' => 'required',
            'status' => 'required',
            'employee_dept_id' => 'required',
            'employee_position_id' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        $employee->where('id', $employee->id)->update($validation);

        // dd($employees);
        return to_route('employees.index')->with(['success', 'Employee successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->where('id', $employee->id)->delete();

        return to_route('employees.index');
    }
}
