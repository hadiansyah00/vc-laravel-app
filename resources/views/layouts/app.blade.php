<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Company Profile') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>


/* resources/css/app.css */
body {
    font-family: 'Poppins', sans-serif;
}
body {
    font-family: 'Poppins', sans-serif;
}
.navbar-nav {
    margin: auto;
}
.navbar-nav .nav-link {
    font-size: 0.875rem; /* smaller font size for navbar links */
}

.dropdown-menu .dropdown-item {
    font-size: 0.875rem; /* smaller font size for dropdown items */
}

    </style>
    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen bg-light">


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="container py-6">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container py-4">
            @include('layouts.navigation')
             @if (session('success'))
                 <div   div class="alert alert-warning alert-dismissible fade show" role="alert" role="alert">
            {{ session('success') }}
        </div>
    @endif
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
