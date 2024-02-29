@extends('adminlte::page')

@section('title', 'All Device Locations')

@section('content_header')
<h1>All Device Locations</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('device_locations.create') }}" class="btn btn-success text-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
    </div>
    <table class="table table-bordered" id="deviceLocationsTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $location->code }}</td>
                <td>{{ $location->name }}</td>
                <td>
                    <div class="action-form d-flex justify-content-center">
                        <a href="{{ route('device_locations.edit', $location->id) }}" class="btn btn-primary mr-lg-2"><i
                                class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                        <form action="{{ route('device_locations.destroy', $location->id) }}" method="post"
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
        $('#deviceLocationsTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
