@extends('adminlte::page')

@section('title', 'Hospitals')

@section('content_header')
    <h1 class="font-weight-bold">Hospitals</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('hospitals.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus"
                aria-hidden="true"></i>Create New
        </a>
    </div>
    <table class="table table-bordered" id="hospitalsTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hospitals as $hospital)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hospital->name }}</td>
                    <td>{{ $hospital->phone_number}}</td>
                    <td>{{ $hospital->email }}</td>
                    <td>{{ $hospital->address }}</td>
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
        $('#hospitalsTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
