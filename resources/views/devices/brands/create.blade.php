@extends('adminlte::page')

@section('title', 'Tambah Device Brand')

@section('content_header')
<h1>Tambah Device Brand</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('device_brands.index') }}" class="btn btn-primary text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('device_brands.store') }}" method="post" class="pt-5">
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" aria-describedby="code">
            </div>
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
