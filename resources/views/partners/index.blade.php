@extends('adminlte::page')

@section('title', 'Partners')

@section('content_header')
<h1>Partners</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('partners.create') }}" class="btn btn-success text-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
    </div>
    <table class="table table-bordered" id="companyTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">No. NPWP</th>
                <th scope="col">Address</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($partners as $partner)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $partner->code }}</td>
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->email }}</td>
                    <td>{{ $partner->phone_number }}</td>
                    <td>{{ $partner->npwp_number }}</td>
                    <td>{{ $partner->address }}</td>
                    <td>{{ $partner->status }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('partners.destroy', $partner->id) }}" method="post" class="delete-form">
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
        $('#companyTable').DataTable({
            columnDefs: [
            {className : 'text-center', targets: '_all'
            }]
        });
    } );
</script>
@stop
