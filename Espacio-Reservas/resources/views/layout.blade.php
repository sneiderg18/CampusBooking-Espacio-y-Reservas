<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampusBooking Lite')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar{
            margin: 10px 100px;
            background: linear-gradient(90deg, #4A90E2, #9B59B6);
        }
        .navbar-brand{
            color: black;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark  mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('espacios.index') }}">CampusBooking Lite</a>
        <div>
            <a href="{{ route('espacios.index') }}" class="btn btn-outline-light btn-sm">Espacios</a>
            <a href="{{ route('reservas.index') }}" class="btn btn-outline-light btn-sm">Reservas</a>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('contenido')
</div>

</body>
</html>
