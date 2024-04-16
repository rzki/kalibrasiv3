@extends('adminlte::page')

@section('title', 'Add New Company')

@section('content_header')
<h1>Add New Company</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('companies.index') }}" class="btn btn-primary text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('companies.store') }}" method="post" class="pt-5">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="parent_company" class="form-label">Parent Company</label>
                        <input type="text" class="form-control" name="parent_company" id="parent_company" aria-describedby="parent_company">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            aria-describedby="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="plan" class="form-label">Plan</label>
                        <select name="plan" class="form-control" id="plan">
                            <option value="">Please select</option>
                            <option value="Silver">Silver</option>
                            <option value="Gold">Gold</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" aria-describedby="code">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address"
                            aria-describedby="address"></textarea>
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
