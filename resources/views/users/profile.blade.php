@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
<h1>My Profile</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title pt-3">
                <h4 class="text-center font-weight-bolder">Profile</h4>
            </div>
            <div class="card-body text-center">
                <h5 class="font-weight-bold">Name</h5>
                <p>{{ $user->name }}</p>
                <br>
                <h5 class="font-weight-bold">Email</h5>
                <p>{{ $user->email }}</p>
                <br>
                <a href="{{ route('users.profile.edit', $user->userId) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i> Update Profile</a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title pt-3">
                <h4 class="text-center font-weight-bolder">Password</h4>
            </div>
            <div class="card-body text-center">
                <h5 class="font-weight-bold">Change your password <br> by clicking button below</h5>
                <br>
                <a href="{{ route('users.profile.password.edit') }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i> Update Password</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
