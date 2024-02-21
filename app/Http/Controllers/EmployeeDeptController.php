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
        $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        EmployeeDept::create($request->all());

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
    public function edit($dept)
    {
        $employeeDept = EmployeeDept::findOrFail($dept);

        // return dd($employeeDept);
        return view('employees.depts.edit', compact('employeeDept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dept)
    {
        $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        $employeeDept = EmployeeDept::findOrFail($dept);

        $employeeDept->update($request->all());

        return to_route('employee_depts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($dept)
    {
        $employeeDept = EmployeeDept::find($dept);
        $employeeDept->delete();

        return to_route('employee_depts.index');
    }
}
