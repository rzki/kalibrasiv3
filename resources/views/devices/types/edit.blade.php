@extends('adminlte::page')

@section('title', 'Edit Device Type')

@section('content_header')
<h1>Edit Device Type</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('device_types.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('device_types.update', $type->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="brand_id" class="form-label">Brands</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">Please select</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"{{ old('brand_id', $type->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" aria-describedby="code" value="{{ old('code', $type->code) }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ old('name', $type->name) }}">
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
