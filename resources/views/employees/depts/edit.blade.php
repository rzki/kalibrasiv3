@extends('adminlte::page')

@section('title', 'Edit Department')

@section('content_header')
<h1>Edit Department</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
            <a href="{{ route('employee_depts.index') }}" class="btn btn-primary text-right">
                <i class="fas fa-arrow-left pr-2"></i>
                Back
            </a>
        </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('employee_depts.update', $dept->id) }}" method="POST" class="pt-5">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $dept->code)  }}" aria-describedby="code">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dept->name)  }}" aria-describedby="name">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="Active" @if (old('status', $dept->status) == "Active") {{ 'selected' }} @endif>Active</option>
                    <option value="Inactive" @if (old('status', $dept->status) == "Inactive") {{ 'selected' }} @endif>Inactive</option>
                </select>
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
