@extends('adminlte::page')

@section('title', 'Inventories')

@section('content_header')
<h1>Inventories</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col d-flex justify-content-end pb-3">
            <a href="{{ route('inventories.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus"
                    aria-hidden="true"></i> Create New</a>
        </div>
    </div>
    <div class="table-responsive pb-3">
        <table class="table table-bordered table-hover inventoriesTable text-center" id="inventoriesTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Type</th>
                    <th scope="col">S/N</th>
                    <th scope="col">Procurement Year</th>
                    <th scope="col">Inv. Number</th>
                    <th scope="col">Last Calibrated</th>
                    <th scope="col">PIC</th>
                    <th scope="col">Location</th>
                    <th scope="col">Status</th>
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
        $('#inventoriesTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'},
                {orderable : false, target: 9}],
        });
    });
</script> --}}
<script>
    $(document).ready(function () {
        $('.inventoriesTable').DataTable({
            autoWidth: true,
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'no', orderable: false, searchable: false},
                {data: 'device_name', name: 'devnames.name'},
                {data: 'brand', name: 'brand'},
                {data: 'type', name: 'type'},
                {data: 'sn', name: 'sn'},
                {data: 'procurement_year', name: 'procurement_year'},
                {data: 'inv_number', name: 'inv_number'},
                {data: 'last_calibrated_date', name: 'last_calibrated_date'},
                {data: 'pic', name: 'pic'},
                {data: 'location', name: 'location'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

  });
</script>
@stop
