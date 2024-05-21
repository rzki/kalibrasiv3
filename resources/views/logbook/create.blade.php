@extends('adminlte::page')

@section('title', 'Tambah Logbook')

@section('content_header')
    <h1>Tambah Logbook</h1>
@stop

@section('content')
    <div class="container-fluid px-3">
        <div class="row">
            <div class="col pt-3">
                <a href="{{ route('logbooks.index') }}" class="btn btn-primary text-right"><i
                        class="fas fa-arrow-left pr-2"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="container-fluid px-3">
        <div class="row flex-column">
            <form action="{{ route('logbooks.store') }}" method="post" class="pt-5">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="inventory_id" class="form-label">Device</label>
                            <select name="inventory_id" id="inventory_id" class="form-control">
                                <option value="">Pilih Salah Satu...</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->devnames->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai_pinjam" class="form-label">Mulai Pinjam</label>
                                    <input type="date" name="tanggal_mulai_pinjam" id="tanggal_mulai_pinjam"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai_pinjam" class="form-label">Selesai Pinjam</label>
                                    <input type="date" name="tanggal_selesai_pinjam" id="tanggal_selesai_pinjam"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lokasi_pinjam" class="form-label">Lokasi Pinjam</label>
                                    <input type="text" name="lokasi_pinjam" id="lokasi_pinjam" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="pic" class="form-label">PIC</label>
                                    <input type="text" name="pic" id="pic" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih status...</option>
                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                                <option value="Tersedia">Tersedia</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-success my-3 text-center">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#inventory_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style'
            });
        });
    </script>
@stop
