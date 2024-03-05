@extends('adminlte::page')

@section('title', 'Create New Device')

@section('content_header')
<h1>Create New Device</h1>
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
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices.store') }}" method="post" class="pt-5">
            @csrf

            <div class="row">
                {{-- <div class="col">
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Code</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="barcode">
                    </div>
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer" aria-describedby="manufacturer">
                    </div>
                    <div class="mb-3">
                        <label for="device_location_id" class="form-label">Location</label>
                        <select name="device_location_id" id="device_location_id" class="form-control">
                            @foreach ($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="risk_level" class="form-label">Risk Level</label>
                        <select name="risk_level" id="risk_level" class="form-control">
                            @foreach ($riskLevel as $risk)
                                <option value="{{ $risk }}">{{ $risk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" id="type" aria-describedby="type">
                    </div>
                    <div class="mb-3">
                        <label for="vendor" class="form-label">Vendor</label>
                        <select name="vendor" id="vendor" class="form-control">
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor }}">{{ $vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach ($status as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="device_category_id" class="form-label">Category</label>
                        <select name="device_category_id" id="device_category_id" class="form-control">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" id="serial_number" aria-describedby="serial_number">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select name="condition" id="condition" class="form-control">
                            @foreach ($conditions as $con)
                                <option value="{{ $con }}">{{ $con }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="barcode" class="form-label">Code</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="barcode">
                    </div>
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" id="manufacturer" aria-describedby="manufacturer">
                    </div>
                    <div class="mb-3">
                        <label for="device_location_id" class="form-label">Location</label>
                        <select name="device_location_id" id="device_location_id" class="form-control">
                            @foreach ($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="risk_level" class="form-label">Risk Level</label>
                        <select name="risk_level" id="risk_level" class="form-control">
                            @foreach ($riskLevel as $risk)
                                <option value="{{ $risk }}">{{ $risk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" id="type" aria-describedby="type">
                    </div>
                    <div class="mb-3">
                        <label for="vendor" class="form-label">Vendor</label>
                        <select name="vendor" id="vendor" class="form-control">
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor }}">{{ $vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach ($status as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="device_category_id" class="form-label">Category</label>
                        <select name="device_category_id" id="device_category_id" class="form-control">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" id="serial_number" aria-describedby="serial_number">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select name="condition" id="condition" class="form-control">
                            @foreach ($conditions as $con)
                                <option value="{{ $con }}">{{ $con }}</option>
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
