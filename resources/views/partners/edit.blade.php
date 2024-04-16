@extends('adminlte::page')

@section('title', 'Edit Company')

@section('content_header')
<h1>Edit Company</h1>
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
        <form action="{{ route('partners.update', $partner->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" id="code" aria-describedby="code" value="{{ old('code', $partner->code) }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="email" value="{{ old('email', $partner->email) }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            aria-describedby="phone_number" value="{{ old('phone_number', $partner->phone_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude"
                            aria-describedby="latitude" value="{{ old('latitude', $partner->latitude) }}">
                    </div>
                    <div class="mb-3">
                        <label for="partner_category_id" class="form-label">Category</label>
                        <select name="partner_category_id" class="form-control" id="partner_category_id">
                            <option value="">Please select</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"{{ old('partner_category_id', $partner->partner_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ old('name', $partner->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="npwp_number" class="form-label">No. NPWP</label>
                        <input type="text" class="form-control" name="npwp_number" id="npwp_number"
                            aria-describedby="npwp_number" value="{{ old('npwp_number', $partner->npwp_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" aria-describedby="address"
                            style="height:37px">{{ old('address', $partner->address) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude"
                            aria-describedby="longitude" value="{{ old('longitude', $partner->longitude) }}">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Please select</option>
                            <option value="Active"@if (old('status', $partner->status) == "Active") {{ 'selected' }}
                        @endif>Active</option>
                            <option value="Inactive"@if (old('status', $partner->status) == "Inactive") {{ 'selected' }}
                        @endif>Inactive</option>
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
