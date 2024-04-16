@extends('adminlte::page')

@section('title', 'Device Details')

@section('content_header')
<h1>Device Details</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row py-3">
        <a href="{{ route('devices.index') }}" class="btn btn-primary text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <x-adminlte-card>
                <div class="text-center font-weight-bolder">
                    {!! DNS2D::getBarcodeSVG(route('devices.show', $device->serial_number), 'QRCODE') !!}
                    <h2>{{ $device->name }}</h2>
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-lg-8">
            <x-adminlte-card>
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Name</h4>
                            <p>{{ $device->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Serial Number</h4>
                            <p>{{ $device->serial_number }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Last Calibration Date</h4>
                            <p>{{ $device->calibration_date }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Brand</h4>
                            <p>{{ $device->brands->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Type</h4>
                            <p>{{ $device->types->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-weight-bolder">Next Calibration Date</h4>
                            <p>{{ $device->next_calibration_date }}</p>
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
