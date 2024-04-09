<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDept;
use Illuminate\Http\Request;
use App\Models\EmployeePosition;
use App\DataTables\EmployeesDataTable;
use App\Http\Requests\EmployeeRequest;

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
    public function store(EmployeeRequest $r)
    {

        Employee::create([
            'name' => $r->name,
            'nid' => $r->nid,
            'type' => $r->type,
            'status' => $r->status,
            'email' => $r->email,
            'phone_number' => $r->phone_number,
            'employee_dept_id' => $r->employee_dept_id,
            'employee_position_id' => $r->employee_position_id
        ]);

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
    public function update(EmployeeRequest $r, Employee $employee)
    {
        $employee->where('id', $employee->id)->update([
            'name' => $r->name,
            'nid' => $r->nid,
            'type' => $r->type,
            'status' => $r->status,
            'email' => $r->email,
            'phone_number' => $r->phone_number,
            'employee_dept_id' => $r->employee_dept_id,
            'employee_position_id' => $r->employee_position_i
        ]);

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
