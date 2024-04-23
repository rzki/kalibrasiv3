@extends('adminlte::page')

@section('title', 'Hospitals')

@section('content_header')
    <h1 class="font-weight-bold">Hospitals</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
            <a href="{{ route('hospitals.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus"
                    aria-hidden="true"></i> Create New
            </a>
        </div>
    </div>
    <div class="table-responsive pb-3">
        <table class="table table-bordered table-hover hospitalsTable text-center" id="hospitalsTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
{{-- <script>
    $(document).ready( function () {
        $('#hospitalsTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script> --}}
<script>
    $(document).ready(function () {
        $('.hospitalsTable').DataTable({
            autoWidth: true,
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('hospitals.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'no', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

  });
</script>
@stop
