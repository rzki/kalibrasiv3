<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $device->names->name ?? '' }} - SIMAK</title>

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.3.3/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
