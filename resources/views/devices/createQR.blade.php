@extends('adminlte::page')

@section('title', 'Tambah Device')

@section('content_header')
<h1>Tambah Device</h1>
@stop

@section('content')
<div class="container-fluid px-3">
    <div class="row">
        <div class="col pt-3">
            <a href="{{ route('devices.index') }}" class="btn btn-primary text-right">
                <i class="fas fa-arrow-left pr-2"></i>
                Back
            </a>
        </div>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="row flex-column">
        <form action="{{ route('devices.storeQR') }}" method="post" class="pt-5">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="number" class="form-label">Jumlah QR yang ingin dibuat (max. 1000 dalam sekali generate)</label>
                        <input type="number" name="number" id="number" class="form-control" min="1" max="1000">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary my-3 text-center">Submit</button>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
