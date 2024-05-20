@extends('adminlte::page')

@section('title', 'Logbooks')

@section('content_header')
    <h1>Logbook</h1>
@stop

@section('content')
    <div class="container-fluid px-3">
        <div class="row">
            <div class="col d-flex justify-content-end pb-3">
                <a href="{{ route('logbooks.create') }}" class="btn btn-success ml-3"><i class="fas fa-plus"
                        aria-hidden="true"></i> Create New</a>
            </div>
        </div>
        <div class="table-responsive pb-3">
            <table class="table table-bordered table-hover logbookTable text-center" id="logbookTable">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">S/N</th>
                        <th scope="col">Inv Number</th>
                        <th scope="col">Lokasi Pinjam</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">PIC</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.logbookTable').DataTable({
                autoWidth: true,
                lengthMenu: [
                    [10, 25, 50, 100, 250, 500, -1],
                    [10, 25, 50, 100, 250, 500, 'All']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('logbooks.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'no',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'inventories.name',
                        name: 'inventories.name'
                    },
                    {
                        data: 'inventories.brand',
                        name: 'inventories.brand'
                    },
                    {
                        data: 'inventories.type',
                        name: 'inventories.type'
                    },
                    {
                        data: 'inventories.sn',
                        name: 'inventories.sn'
                    },
                    {
                        data: 'inventories.inv_number',
                        name: 'inventories.inv_number'
                    },
                    {
                        data: 'lokasi_peminjaman',
                        name: 'lokasi_peminjaman'
                    },
                    {
                        data: 'tanggal_peminjaman',
                        name: 'tanggal_peminjaman'
                    },
                    {
                        data: 'pic',
                        name: 'pic'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
