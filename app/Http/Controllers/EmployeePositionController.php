<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeePositionDataTable;
use App\Models\EmployeePosition;
use Illuminate\Http\Request;

class EmployeePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeePosition = EmployeePosition::latest()->get();

        return view('employees.positions.index', compact('employeePosition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|min:3|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        EmployeePosition::create([
            'code' => $request['code'],
            'name' => $request['name'],
            'status' => $request['status'],

        ]);

        return to_route('employee_positions.index')->with(['success' => 'Employee Position successfully created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($position)
    {
        $employeePositions = EmployeePosition::findOrFail($position);
        return view('employees.positions.edit', compact('employeePositions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $position)
    {
        $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        $employeePosition = EmployeePosition::findOrFail($position);

        $employeePosition->update($request->all());

        return to_route('employee_positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($position)
    {
        $employeePositions = EmployeePosition::find($position);
        $employeePositions->delete();

        return to_route('employee_positions.index');
    }
}
