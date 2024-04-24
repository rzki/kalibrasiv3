@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
            <a href="{{ route('users.create') }}" class="btn btn-success text-right mr-2"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importUser"><i class="fa-solid fa-upload"></i> Import</button>
        </div>

    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover usersTable text-center" id="usersTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="importUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <small class="text-muted ml-3">(Format file yang didukung : .xlsx, .xls, .pdf)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload"></i> Import</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i>
                        Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#usersTable').DataTable({
autoWidth: true,
            lengthMenu: [
            [10, 25, 50, 100, 250, -1],
            [10, 25, 50, 100, 250, 'All']
            ],
            pageLength: 100,
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'no', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'roles.name', name: 'roles.name', width:'30%'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    } );
</script>
@stop
