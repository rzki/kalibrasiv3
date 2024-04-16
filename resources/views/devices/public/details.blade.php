@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex flex-column align-content-center justify-content-center vh-100">
            <div class="col-lg-6 text-center">
                @if (Auth::check())
                   <a href="{{ route('devices.index') }}" class="btn btn-block btn-primary w-100">Back to Devices</a>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="row d-flex flex-column justify-content-center align-items-center p-5">
                    <div class="col-lg-3 text-center">
                        <img src="{{ asset('storage/'.$device->barcode) }}" alt="">
                    </div>
                    <div class="col-lg-9 text-center">
                        <div class="row py-3">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h4 class="font-weight-bolder">Name</h4>
                                    <p>{{ $device->names->name ?? '' }}</p>
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
                                    <p>{{ $device->brand }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="font-weight-bolder">Type</h4>
                                    <p>{{ $device->type }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="font-weight-bolder">Next Calibration Date</h4>
                                    <p>{{ $device->next_calibration_date }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-4">
                                <h4 class="font-weight-bolder">Location</h4>
                                <p>{{ $device->hospitals->name ?? '' }}</p>
                            </div>
                        </div>
                        @if (Auth::guest() && $device->name == null)
                        <a href="{{ route('devices.edit', $device->deviceId) }}" class="btn btn-danger btn-block w-100">Login to Update Data</a>
                        <script>
                            sessionStorage.setItem('intended_url', route('devices.qr', $device->deviceId));
                            </script>
                        @elseif(Auth::check())
                            <a href="{{ route('devices.edit', $device->deviceId) }}" class="btn btn-success w-100">Update Data</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
