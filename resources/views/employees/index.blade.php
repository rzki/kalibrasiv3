@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<h1>Employee</h1>
@stop

@section('content')
<div class="container">
    <div class="row d-flex justify-content-end">
        <a href="{{ route('employees.create') }}" class="btn btn-primary text-right">Create New Employee</a>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
