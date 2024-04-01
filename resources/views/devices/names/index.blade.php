@extends('adminlte::page')

@section('title', 'Device Name')

@section('content_header')
<h1>Device Name</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
            <a href="{{ route('devices_name.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus"
                    aria-hidden="true"></i>Create New</a>
        </div>
    </div>
    <div class="pb-3">
        <table class="table table-bordered" id="devicesNameTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Action</th>
                    <th scope="col"><input type="checkbox" name="checkboxAll" id="checkboxAll"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($names as $name)
                <tr id="devId{{ $name->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $name->name }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('devices_name.edit', $name->id) }}" class="btn btn-primary mr-lg-2"><i
                                    class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('devices_name.destroy', $name->id) }}" method="post"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </td>
                    <td><input type="checkbox" name="nameIds" class="checkboxClass" data-id="{{ $name->id }}"></td>
                    {{-- <td><input type="checkbox" name="deviceIds" class="checkboxClass" data-id="{{ $device->deviceId }}"></td>--}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#devicesNameTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'},
                {orderable : false, target: 3}
            ],
        });
    });
</script>
@stop
