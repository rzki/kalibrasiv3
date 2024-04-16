@extends('adminlte::page')

@section('title', 'Edit Device Name')

@section('content_header')
<h1>Edit Device Name</h1>
@stop

@section('content')
<div class="pt-3">
    <a href="{{ route('devices_name.index') }}" class="btn btn-primary text-right">
        <i class="fas fa-arrow-left pr-2"></i>
        Back
    </a>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices_name.update', $deviceName->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ old('name', $deviceName->name) }}">
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
