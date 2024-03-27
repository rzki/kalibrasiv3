@extends('adminlte::page')

@section('title', $hospital->name )

@section('content_header')
<h1>{{ $hospital->name }}</h1>
@stop

@section('content')
<div class="container-fluid pt-lg-5 px-lg-3">
    <div class="row pt-3">
        <a href="{{ route('hospitals.index') }}" class="btn btn-info text-right">
            <i class="fas fa-arrow-left pr-2"></i>
            Back
        </a>
    </div>
    <div class="row d-flex justify-content-end pb-lg-3 px-lg-3">
        <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-primary ml-3 mr-2"><i class="fa fa-edit"
                aria-hidden="true"></i> Edit
        </a>
        <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="post"
            class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete
            </button>
        </form>
    </div>
    <div class="row hospital-details">
        <div class="col-lg-6">
            <div class="row border border-dark border-3 py-lg-3">
                <div class="col-lg-6 hospital-first-col text-center">
                    <div class="mb-lg-4">
                        <h4 class="font-weight-bolder">Name</h4>
                        <p>{{ $hospital->name }}</p>
                    </div>
                    <div class="mb-lg-4">
                        <h4 class="font-weight-bolder">Email</h4>
                        <p>{{ $hospital->email }}</p>
                    </div>
                </div>
                <div class="col-lg-6 hospital-second-col text-center">
                    <div class="mb-lg-4">
                        <h4 class="font-weight-bolder">Phone Number</h4>
                        <p>{{ $hospital->phone_number }}</p>
                    </div>
                    <div class="mb-lg-4">
                        <h4 class="font-weight-bolder">Address</h4>
                        <p>{{ $hospital->address }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row hospital-device-list pb-lg-3 mt-lg-5">
        <div class="col mb-3 list-device text-center">
            <h3 class="font-weight-bolder text-center">List Device</h3>
            <table class="table table-bordered" id="devicesTable">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">QR Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Type</th>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Cal. Date</th>
                        <th scope="col">Next Cal.</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $dev)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/'.$dev->barcode) }}" alt="" width="200" height="200"></td>
                        <td>{{ $dev->name }}</td>
                        <td>{{ $dev->brands->name ?? '' }}</td>
                        <td>{{ $dev->types->name ?? '' }}</td>
                        <td>{{ $dev->serial_number }}</td>
                        <td>{{ $dev->calibration_date }}</td>
                        <td>{{ $dev->next_calibration_date }}</td>
                        <td>{{ $dev->status }}</td>
                        <td>
                            <div class="action-form d-flex justify-content-center">
                                <a href="{{ route('devices.qr', $dev->deviceId) }}"
                                    class="btn btn-info mr-lg-2"><i class="fa fa-circle-info" aria-hidden="true"></i></a>
                                <a href="{{ route('devices.edit', $dev->deviceId) }}"
                                    class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                                <a href="{{ route('devices.print', $dev->deviceId) }}" class="btn btn-secondary mr-lg-2" target="__blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                <form action="{{ route('devices.destroy', $dev->deviceId) }}" method="post"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
