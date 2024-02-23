@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary text-right">Create New User</a>
    </div>
    <table class="table table-bordered" id="usersTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post" class="delete-form">
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
        $('#usersTable').DataTable({
            columnDefs: [
            {className : 'text-center', targets: '_all'
            }]
        });
    } );
</script>
@stop