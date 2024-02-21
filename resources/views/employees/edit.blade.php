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
        <form action="{{ route('employees.update', $employees->id) }}" method=" " class="pt-5">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" value="{{ old('name', $employees->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="depts" class="form-label">Department</label>
                        <select class="form-control" id="depts" aria-describedby="depts">
                            <option value="">....</option>
                            <option value="Pegawai Tetap">Pegawai Tetap</option>
                            <option value="Pegawai Kontrak">Pegawai Kontrak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" aria-describedby="type">
                            <option value="Pegawai Tetap">Pegawai Tetap</option>
                            <option value="Pegawai Kontrak">Pegawai Kontrak</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="nid" class="form-label">NID</label>
                        <input type="text" class="form-control" id="nid">
                    </div>
                    <div class="mb-3">
                        <label for="positions" class="form-label">Positions</label>
                        <select class="form-control" id="positions" aria-describedby="positions">
                            <option value="">....</option>
                            <option value="Pegawai Tetap">Pegawai Tetap</option>
                            <option value="Pegawai Kontrak">Pegawai Kontrak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" aria-describedby="status">
                            <option value="Active">Active</option>
                            <option value="Non Active">Non Active</option>
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
