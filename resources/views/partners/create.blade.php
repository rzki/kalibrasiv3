@extends('adminlte::page')

@section('title', 'Add New Partner')

@section('content_header')
<h1>Add New Partner</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('partners.index') }}" class="btn btn-primary text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('partners.store') }}" method="post" class="pt-5">
            @csrf

            <div class="row">
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
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            aria-describedby="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" aria-describedby="latitude">
                    </div>
                    <div class="mb-3">
                        <label for="partner_category_id" class="form-label">Category</label>
                        <select name="partner_category_id" class="form-control" id="partner_category_id">
                            <option value="">Please select</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="npwp_number" class="form-label">No. NPWP</label>
                        <input type="text" class="form-control" name="npwp_number" id="npwp_number" aria-describedby="npwp_number">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address"
                            aria-describedby="address" style="height:37px"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" aria-describedby="longitude">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Please select</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
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
