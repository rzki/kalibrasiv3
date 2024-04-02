@extends('adminlte::page')

@section('title', 'Edit Device')

@section('content_header')
<h1>Edit Device</h1>
@stop

@section('content')
<div class="pt-3">
    <a href="{{ route('devices.index') }}" class="btn btn-info text-right">
        <i class="fas fa-arrow-left pr-2"></i>
        Back
    </a>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices.update', $device->deviceId) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name_id" class="form-label">Name</label>
                        <select name="name_id" id="name_id" class="form-control">
                            <option value="">Pilih Salah Satu...</option>
                            @foreach ($names as $name)
                                <option value="{{ $name->id }}"{{ old('name_id', $device->name_id) == $name->id ? 'selected' : '' }}>{{ $name->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" placeholder="Brand...">
                    </div>
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="Type...">
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{ old('serial_number', $device->serial_number) }}" placeholder="Serial Number...">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Location...">
                    </div>
                    <div class="mb-3">
                        <label for="hospital_id" class="form-label">Hospital</label>
                        <select name="hospital_id" id="hospital_id" class="form-control">
                            <option value="">Select Hospital...</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"{{ old('hospital_id', $device->hospital_id) == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                            @endforeach
                        </select>
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
