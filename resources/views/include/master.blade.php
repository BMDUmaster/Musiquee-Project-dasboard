<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musiquee Admin Dashboard</title>
    @include('include.head')
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    @include('include.sidebar')

    <!-- Header -->
    @include('include.header')

    <!-- Main Content -->
    @yield('content')
    <!-- Footer -->
    @include('include.footer')

    <!-- Scripts -->
    @include('include.foot')
    @yield('scripts')
</body>
</html>
