@extends('adminlte::page')

@section('title', 'Create New Device Name')

@section('content_header')
<h1>Create New Device Name</h1>
@stop

@section('content')
<div class="pt-3">
    <a href="{{ route('devices_name.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left pr-2"></i>
        Back
    </a>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices_name.store') }}" method="post" class="pt-5">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name">
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
