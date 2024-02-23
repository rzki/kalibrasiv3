@extends('adminlte::page')

@section('title', 'Edit Reference')

@section('content_header')
<h1>Edit Reference</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('references.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('references.update', $reference->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" aria-describedby="code" value="{{ old('code', $reference->code) }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ old('name', $reference->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description"
                            aria-describedby="description">{{ old('description', $reference->description) }}</textarea>
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
