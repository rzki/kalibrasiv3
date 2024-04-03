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
    <div class="pb-3">
        <table class="table table-bordered" id="inventoriesTable">
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
                    <th scope="col">Next Calibrated</th>
                    <th scope="col">PIC</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inv)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $inv->devnames->name }}</td>
                        <td>{{ $inv->brand }}</td>
                        <td>{{ $inv->type }}</td>
                        <td>{{ $inv->sn }}</td>
                        <td>{{ $inv->procurement_year }}</td>
                        <td>{{ $inv->inv_number }}</td>
                        <td>{{ $inv->last_calibrated_date }}</td>
                        <td>{{ $inv->next_calibrated_date }}</td>
                        <td>{{ $inv->pic }}</td>
                        <td>{{ $inv->location }}</td>
                        <td>
                            <div class="action-form d-flex justify-content-center">
                                <a href="{{ route('inventories.edit', $inv->inv_id) }}" class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                                <form action="{{ route('inventories.destroy', $inv->inv_id) }}" method="post"
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
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#inventoriesTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'},
                {orderable : false, target: 9}],
        });
    });
</script>
@stop
