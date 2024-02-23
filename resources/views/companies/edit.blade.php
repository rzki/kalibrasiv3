@extends('adminlte::page')

@section('title', 'Edit Company')

@section('content_header')
<h1>Edit Company</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('companies.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('companies.update', $company->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="parent_company" class="form-label">Parent Company</label>
                        <input type="text" class="form-control" name="parent_company" id="parent_company"
                            aria-describedby="parent_company" value="{{ old('parent_company', $company->parent_company) }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ old('name', $company->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            aria-describedby="phone_number" value="{{ old('phone_number', $company->phone_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="plan" class="form-label">Plan</label>
                        <select name="plan" class="form-control" id="plan">
                            <option value="">Please select</option>
                            <option value="Silver" @if (old('plan', $company->plan) === "Silver") {{ 'selected' }} @endif>Silver</option>
                            <option value="Gold" @if (old('plan', $company->plan) === "Gold") {{ 'selected' }} @endif>Gold</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" aria-describedby="code"value="{{ old('code', $company->code) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="email"value="{{ old('email', $company->email) }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address"
                            aria-describedby="address">{{ old('address', $company->address) }}</textarea>
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
