@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
<h1>Edit Employee</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
            <a href="{{ route('employees.index') }}" class="btn btn-info text-right">
                <i class="fas fa-arrow-left pr-2"></i>
                Back
            </a>
        </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ old('name', $employee->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="email"value="{{ old('email', $employee->email) }}">
                    </div>
                    <div class="mb-3">
                        <label for="employee_dept_id" class="form-label">Department</label>
                        <select class="form-control" id="employee_dept_id" name="employee_dept_id" aria-describedby="employee_dept_id">
                            <option value="">....</option>
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}"{{ old('depts', $employee->employee_dept_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type" aria-describedby="type">
                            <option value="">...</option>
                            <option value="Pegawai Tetap" @if(old('type', $employee->type) == "Pegawai Tetap") {{ 'selected' }} @endif>Pegawai Tetap</option>
                            <option value="Pegawai Kontrak" @if(old('type', $employee->type) == "Pegawai Kontrak") {{ 'selected' }} @endif>Pegawai Kontrak</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="nid" class="form-label">NID</label>
                        <input type="text" class="form-control" name="nid" id="nid" value="{{ old('nid', $employee->nid) }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" aria-describedby="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="employee_position_id" class="form-label">Positions</label>
                        <select class="form-control" name="employee_position_id" id="employee_position_id" aria-describedby="employee_position_id">
                            <option value="">....</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}"{{ old('positions', $employee->employee_position_id) == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status" aria-describedby="status">
                            <option value="Active" @if(old('status', $employee->status) == "Active") {{ 'selected' }} @endif>Active</option>
                            <option value="Non Active" @if(old('status', $employee->status) == "Non Active") {{ 'selected' }} @endif>Non Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary text-center">Submit</button>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
