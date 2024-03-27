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
                    <td>
                        <div class="action-form d-flex justify-content-center">

                            <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-info mr-lg-2"><i class="fas fa-info-circle"></i></a>
                            <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-primary mr-lg-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="post"
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
        $('#hospitalsTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
