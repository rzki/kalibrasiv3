@extends('adminlte::page')

@section('title', 'vCards')

@section('content_header')
    <h1 class="font-weight-bold">vCards</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('vcards.create') }}" class="btn btn-success ml-3"><i class="fa fa-plus"
                aria-hidden="true"></i>Create New
        </a>
    </div>
    <table class="table table-bordered" id="vCardsTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Barcode</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vcards as $vcard)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vcard->name }}</td>
                    <td>{{ $vcard->phone_number}}</td>
                    <td>{{ $vcard->email }}</td>
                    <td>{{ $vcard->address }}</td>
                    <td><img src="{{ asset('storage/'.$vcard->barcode) }}" alt=""></td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('vcards.edit', $vcard->id) }}" class="btn btn-primary mr-lg-2"><i
                                    class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('vcards.destroy', $vcard->id) }}" method="post" class="delete-form">
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
        $('#vCardsTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
