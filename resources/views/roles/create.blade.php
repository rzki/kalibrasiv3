@extends('adminlte::page')

@section('title', 'Create New Role')

@section('content_header')
<h1>Create New Role</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col pt-3">
            <a href="{{ route('roles.index') }}" class="btn btn-info text-right">
                <i class="fas fa-arrow-left pr-2"></i>
                Back
            </a>
        </div>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('roles.store') }}" method="post" class="pt-5">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
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
