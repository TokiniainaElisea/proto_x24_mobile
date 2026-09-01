<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">
    <title>Proto</title>
</head>

<body class="keyboard-visible">

        @include('navbar')
        @yield('content')

    <script src="{{ asset('js/chart.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
