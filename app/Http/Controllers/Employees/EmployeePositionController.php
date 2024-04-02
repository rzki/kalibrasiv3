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
        $validation = $this->validate($request, [
            'code' => 'required|max:6',
            'name' => 'required|max:50',
            'status' => 'required'
        ]);

        EmployeePosition::create($validation);

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
    public function edit(EmployeePosition $position)
    {
        return view('employees.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeePosition $position)
    {
        $validation = $this->validate($request, [
            'code' => 'required|min:2|max:6',
            'name' => 'required|min:3|max:50',
            'status' => 'required'
        ]);

        $position->where('id', $position->id)->update($validation);

        return to_route('employee_positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeePosition $position)
    {
        $position->where('id', $position->id)->delete();

        return to_route('employee_positions.index');
    }
}
