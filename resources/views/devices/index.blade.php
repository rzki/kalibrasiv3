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
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">SN</th>
                <th scope="col">Category</th>
                <th scope="col">Location</th>
                <th scope="col">Condition</th>
                <th scope="col">Risk Level</th>
                <th scope="col">Vendor</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $device->barcode }}</td>
                <td>{{ $device->name }}</td>
                <td>{{ $device->type }}</td>
                <td>{{ $device->manufacturer }}</td>
                <td>{{ $device->serial_number }}</td>
                <td>{{ $device->categories->name }}</td>
                <td>{{ $device->locations->name }}</td>
                <td>
                    <div class="action-form d-flex justify-content-center">
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
