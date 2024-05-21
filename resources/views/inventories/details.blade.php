@extends('adminlte::page')

@section('title', 'Detail Inventaris')

@section('content_header')
    <h1>Detail Inventaris</h1>
@stop

@section('content')
    <div class="container-fluid px-3">
        <div class="row">
            <div class="col d-flex justify-content-start py-3">
                <a href="{{ route('inventories.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left" aria-hidden="true"></i> Kembali</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-styles">
                    <div class="row p-3 pb-lg-5">
                        <h3 class="fw-bold text-center">Detail Inventaris</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row justify-content-center align-content-center">
                                <div class="col-lg-3">
                                    <h5 class="fw-medium mb-3">Invoice No.</h5>
                                    <h5 class="fw-medium mb-3">Nama Alat</h5>
                                    <h5 class="fw-medium mb-3">Merk</h5>
                                    <h5 class="fw-medium mb-3">Tipe</h5>
                                </div>
                                <div class="col-lg-5">
                                    <h5 class="fw-normal mb-3">{{ $inventory->inv_number }}</h5>
                                    <h5 class="fw-normal mb-3">{{ $inventory->devnames->name }}</h5>
                                    <h5 class="fw-normal mb-3">{{ $inventory->brand }}</h5>
                                    <h5 class="fw-normal mb-3">{{ $inventory->type }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="fw-medium mb-3">S/N</h5>
                                    <h5 class="fw-medium mb-3">Tahun Pengadaan</h5>
                                    <h5 class="fw-medium mb-3">Kalibrasi Terakhir</h5>
                                    <h5 class="fw-medium mb-3">Kalibrasi Selanjutnya</h5>
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="fw-normal mb-3">{{ $inventory->sn }}</h5>
                                    <h5 class="fw-normal mb-3">{{ $inventory->procurement_year }}</h5>
                                    <h5 class="fw-normal mb-3">{{ date('j F Y', strtotime($inventory->last_calibrated_date)) }}
                                    </h5>
                                    <h5 class="fw-normal mb-3">{{ date('j F Y', strtotime($inventory->next_calibrated_date)) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-styles">
                    <div class="row p-3 pb-lg-5">
                        <h3 class="fw-bold text-center">Histori Peminjaman</h3>
                    </div>
                    <div class="row mb-3 px-lg-5">
                        <div class="table">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Lokasi</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($logbooks as $log)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('j F Y', strtotime($log->tanggal_mulai_pinjam))}} - {{ date('j F Y', strtotime($log->tanggal_selesai_pinjam)) }}</td>
                                            <td>{{ $log->lokasi_pinjam }}</td>
                                            <td>{{ $log->pic }}</td>
                                            <td>{{ $log->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@stop

@section('js')

@stop
