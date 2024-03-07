@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center vh-100 px-5">
            <div class="col-lg-3 text-center">
                {!! DNS2D::getBarcodeSVG(route('devices.qr', $device->serial_number), 'QRCODE') !!}
            </div>
            <div class="col-lg-9 text-center">
                <div class="row">
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
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
            </div>
        </div>
    </div>
@endsection
