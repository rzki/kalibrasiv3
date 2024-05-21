@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
<h1>Edit Role</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <div class="col pt-3">
            <a href="{{ route('roles.index') }}" class="btn btn-primary text-right">
                <i class="fas fa-arrow-left pr-2"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('roles.update', $role->roleId) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value={{ old('name', $role->name) }}>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-success text-center">Submit</button>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
