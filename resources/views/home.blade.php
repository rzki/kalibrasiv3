@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <x-adminlte-info-box title="Devices" icon="fas fa-fw fa-screwdriver-wrench" text="{{ $devices->count() }}" url="{{ route('devices.index') }}"></x-adminlte-info-box>
        </div>
        <div class="col-lg-6">
            <x-adminlte-info-box title="Users" icon="fas fa-fw fa-users" text="{{ $users->count() }}" url="{{ route('users.index') }}"></x-adminlte-info-box>
        </div>
    </div>
</div>
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
{{-- <script>
    console.log('Hi!');
</script> --}}
@stop

