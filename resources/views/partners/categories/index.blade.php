@extends('adminlte::page')

@section('title', 'Partner Categories')

@section('content_header')
<h1>Partner Categories</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row d-flex justify-content-end pb-3">
        <a href="{{ route('partner_categories.create') }}" class="btn btn-success text-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
    </div>
    <table class="table table-bordered" id="partnerCategoriesTable">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($partnerCategories as $partner)
                <tr>
                    <td>{{ $loop->iteration }}
                    <td>{{ $partner->name }}</td>
                    <td>
                        <div class="action-form d-flex justify-content-center">
                            <a href="{{ route('partner_categories.edit', $partner->id) }}" class="btn btn-primary mr-lg-2"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                            <form action="{{ route('partner_categories.destroy', $partner->id) }}" method="post" class="delete-form">
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
{{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
<script>
    $(document).ready( function () {
        $('#partnerCategoriesTable').DataTable({
            columnDefs: [
                {className : 'text-center', targets: '_all'
            }]
        });
    });
</script>
@stop
