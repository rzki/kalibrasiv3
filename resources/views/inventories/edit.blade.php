@extends('adminlte::page')

@section('title', 'Edit Inventory')

@section('content_header')
<h1>Edit Inventory</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col pt-3">
            <a href="{{ route('inventories.index') }}" class="btn btn-primary text-right"><i class="fas fa-arrow-left pr-2"></i>Kembali</a>
        </div>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('inventories.update', $inventory->inventoryId) }}" method="post" class="pt-5">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="device_name" class="form-label">Device Name</label>
                        <select name="device_name" id="device_name" class="form-control">
                            <option value="">Pilih Salah Satu...</option>
                            @foreach ($names as $name)
                            <option value="{{ $name->id }}"{{ old('device_name', $inventory->device_name) == $name->id ? 'selected' : '' }}>{{ $name->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand', $inventory->brand) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $inventory->type) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="sn" class="form-label">Serial Number</label>
                                <input type="text" name="sn" id="sn" class="form-control" value="{{ old('sn', $inventory->sn) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="procurement_year" class="form-label">Procurement Year</label>
                                <input type="text" name="procurement_year" id="procurement_year" class="form-control" value="{{ old('procurement_year', $inventory->procurement_year) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inv_number" class="form-label">Inventory Number</label>
                        <input type="text" name="inv_number" id="inv_number" class="form-control" value="{{ old('inv_number', $inventory->inv_number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="last_calibrated_date" class="form-label">Last Calibration</label>
                        <input type="date" name="last_calibrated_date" id="last_calibrated_date"
                            class="form-control" value="{{ old('last_calibrated_date', $inventory->last_calibrated_date) }}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="pic" class="form-label">PIC</label>
                                <input type="text" name="pic" id="pic" class="form-control" value="{{ old('pic', $inventory->pic) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $inventory->location) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Pilih status...</option>
                            @foreach ($statuses as $stt)
                            <option value="{{ $stt }}"{{ old('status', $inventory->status) == $stt ? 'selected' : '' }}>{{ $stt }}</option>
                            @endforeach
                        </select>
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

@stop
