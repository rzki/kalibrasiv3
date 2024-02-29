@extends('adminlte::page')

@section('title', 'All Employees')

@section('content_header')
<h1>Employee</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('employees.create') }}" class="btn btn-success text-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
    </div>
    <table class="table table-bordered" id="employeeTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">NID</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Positions</th>
                <th scope="col">Department</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->nid }}</td>
                    <td>{{ $employee->type }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>{{ $employee->positions->name }}</td>
                    <td>{{ $employee->departments->name }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
        $('#employeeTable').DataTable({
            columnDefs: [
            {className : 'text-center', targets: '_all'
            }]
        });
    } );
</script>
@stop
