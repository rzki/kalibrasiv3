@extends('adminlte::page')

@section('title', 'All Employees')

@section('content_header')
<h1>Employee</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-primary text-right">Create New Employee</a>
    </div>
    {{ $dataTable->table() }}
</div>
@stop

@section('css')

@stop

@section('js')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@stop
