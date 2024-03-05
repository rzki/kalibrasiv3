@extends('adminlte::page')

@section('title', 'All Devices')

@section('content_header')
<h1>All Devices</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('devices.create') }}" class="btn btn-success text-right"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New</a>
    </div>
    <table class="table table-bordered" id="devicesTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Type</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Cal. Date</th>
                <th scope="col">Next Cal.</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->brand }}</td>
                <td>{{ $device->type }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>{{ $device->calibration_date }}</td>
                <td>{{ $device->next_calibration_date }}</td>
                <td>
                    <div class="action-form d-flex justify-content-center">
                        <a href="{{ route('devices.show', $device->id) }}"
                            class="btn btn-info mr-lg-2"><i class="fa fa-circle-info" aria-hidden="true"></i></a>
                        <a href="{{ route('devices.edit', $device->id) }}"
                            class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <form action="{{ route('devices.destroy', $device->id) }}" method="post"
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
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#devicesTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
