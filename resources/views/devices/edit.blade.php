@extends('adminlte::page')

@section('title', 'Edit Device')

@section('content_header')
<h1>Edit Device</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row pt-3">
        <a href="{{ route('devices.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
</div>
{{-- <div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices.update', $device->id) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Code</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="barcode" value="{{ old('barcode', $device->barcode) }}">
                    </div>
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer" aria-describedby="manufacturer" value="{{ old('manufacturer', $device->manufacturer) }}">
                    </div>
                    <div class="mb-3">
                        <label for="device_location_id" class="form-label">Location</label>
                        <select name="device_location_id" id="device_location_id" class="form-control">
                            @foreach ($locations as $loc)
                                <option value="{{ $loc->id }}"{{ old('device_location_id', $device->device_location_id) == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="risk_level" class="form-label">Risk Level</label>
                        <select name="risk_level" id="risk_level" class="form-control">
                            @foreach ($riskLevel as $risk)
                                <option value="{{ $risk }}" {{ old('risk_level', $device->risk_level) == $risk ? 'selected' : '' }}>{{ $risk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ old('name', $device->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" id="type" aria-describedby="type" value="{{ old('type', $device->type) }}">
                    </div>
                    <div class="mb-3">
                        <label for="vendor" class="form-label">Vendor</label>
                        <select name="vendor" id="vendor" class="form-control">
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor }}" {{ old('vendor', $device->vendor) == $vendor ? 'selected' : '' }}>{{ $vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach ($status as $status)
                                <option value="{{ $status }}" {{ old('status', $device->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="device_category_id" class="form-label">Category</label>
                        <select name="device_category_id" id="device_category_id" class="form-control">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('device_category_id', $cat->device_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" id="serial_number" aria-describedby="serial_number" value="{{ old('serial_number', $device->serial_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select name="condition" id="condition" class="form-control">
                            @foreach ($conditions as $con)
                                <option value="{{ $con }}" {{ old('condition', $device->condition) == $con ? 'selected' : '' }}>{{ $con }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary my-3 text-center">Submit</button>
        </form>
    </div>
</div> --}}
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices.update', $device->deviceId) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $device->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"{{ old('brand_id', $device->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select name="type_id" id="type_id" class="form-control">
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}"{{ old('type_id', $device->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{ old('serial_number', $device->serial_number) }}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="calibration_date" class="form-label">Last Calibration Date</label>
                                <input type="date" name="calibration_date" id="calibration_date" class="form-control" value="{{ old('calibration_date', $device->calibration_date) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="next_calibration_date" class="form-label">Next Calibration Date</label>
                                <input type="date" name="next_calibration_date" id="next_calibration_date"
                                    class="form-control" value="{{ old('next_calibration_date', $device->next_calibration_date) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach ($status as $st)
                                <option value="{{ $st }}"{{ old('status', $device->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary my-3 text-center">Submit</button>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
