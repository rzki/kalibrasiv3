<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDeptDataTable;
use App\Models\EmployeeDept;
use Illuminate\Http\Request;

class EmployeeDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeDept = EmployeeDept::latest()->get();

        return view('employees.depts.index', compact('employeeDept'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.depts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        EmployeeDept::create($validation);

        return to_route('employee_depts.index')->with(['success', 'Employee Department successfully created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($employeeDept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeDept $dept)
    {
        return view('employees.depts.edit', compact('dept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeDept $dept)
    {
        $validation = $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        $dept->where('id', $dept->id)->update($validation);

        return to_route('employee_depts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeDept $dept)
    {
        $dept->where('id', $dept->id)->delete();

        return to_route('employee_depts.index');
    }
}
