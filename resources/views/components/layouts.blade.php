<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapsec | {{ $title }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- My Own CSS-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Custom CSS -->
    @stack('customcss')

</head>

<body>
    <!-- header -->
    <x-header><img src="{{ asset('img/logo.png') }}" alt=""
            style="max-width: 25px;  max-height: 25px; margin-right: 10px;">Zafran
        Laptop</x-header>

    <!-- Main Content Include Footer --->
    {{ $slot }}


    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--- Script Sweet Alert 2 --->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('customscript')

</body>

</html>
