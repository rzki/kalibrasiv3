@extends('adminlte::page')

@section('title', 'Edit Device')

@section('content_header')
<h1>Edit Device</h1>
@stop

@section('content')
<div class="pt-3">
    <a href="{{ route('devices.index') }}" class="btn btn-primary text-right">
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
                        <select name="name_id" id="name_id" class="form-control @error('name_id') is-invalid @enderror">
                            <option value="">Pilih Salah Satu...</option>
                            @foreach ($names as $name)
                                <option value="{{ $name->id }}"{{ old('name_id', $device->name_id) == $name->id ? 'selected' : '' }}>{{ $name->name }}</option>
                            @endforeach
                        </select>
                        {{-- Error Messages --}}
                        @error('name_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" placeholder="Brand..." value="{{ old('brand', $device->brand) }}">
                        {{-- Error Messages --}}
                        @error('brand')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" id="type" class="form-control @error('type') @enderror" placeholder="Type..." value="{{ old('type', $device->type) }}">
                        {{-- Error Messages --}}
                        @error('type')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') @enderror" value="{{ old('serial_number', $device->serial_number) }}" placeholder="Serial Number...">
                        {{-- Error Messages --}}
                        @error('serial_number')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control @error('location') @enderror" placeholder="Location..." value="{{ old('location', $device->location)}}">
                        {{-- Error Messages --}}
                        @error('location')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="hospital_id" class="form-label">Hospital</label>
                        <select name="hospital_id" id="hospital_id" class="form-control @error('hospital_id') @enderror ">
                            <option value="">Select Hospital...</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"{{ old('hospital_id', $device->hospital_id) == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                            @endforeach
                        </select>
                        {{-- Error Messages --}}
                        @error('hospital_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="calibration_date" class="form-label">Last Calibration Date</label>
                        <input type="date" name="calibration_date" id="calibration_date" class="form-control @error('calibration_date') @enderror" value="{{ old('calibration_date', $device->calibration_date) }}">
                        {{-- Error Messages --}}
                        @error('calibration_date')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') @enderror">
                            @foreach ($status as $st)
                                <option value="{{ $st }}"{{ old('status', $device->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                        {{-- Error Messages --}}
                        @error('status')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-success my-3 text-center">Submit</button>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#name_id').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@stop
