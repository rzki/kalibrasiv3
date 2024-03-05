@extends('adminlte::page')

@section('title', 'Device Details')

@section('content_header')
<h1>Device Details</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row py-3">
        <a href="{{ route('devices.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <x-adminlte-card>
                <div class="text-center font-weight-bolder">
                    <h2>{{ $device->name }}</h2>
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-lg-8">
            <x-adminlte-card>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Code</h5>
                            <p>{{ $device->barcode }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Manufacturer</h5>
                            <p>{{ $device->manufacturer }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Category</h5>
                            <p>{{ $device->categories->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Risk Level</h5>
                            <p>{{ $device->risk_level }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Name</h5>
                            <p>{{ $device->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Serial Number</h5>
                            <p>{{ $device->serial_number }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Location</h5>
                            <p>{{ $device->locations->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Status</h5>
                            <p>{{ $device->status }}</p>
                        </div>

                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Type</h5>
                            <p>{{ $device->type }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Vendor</h5>
                            <p>{{ $device->vendor }}</p>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-weight-bolder">Condition</h5>
                            <p>{{ $device->condition }}</p>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
