<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assetsindex/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href='{{ asset('assetsindex/img/favicons/favicon-32x32.png') }}'>
    <link rel="icon" type="image/png" sizes="16x16"
        href='{{ asset('assetsindex/img/favicons/favicon-16x16.png') }}'>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsindex/img/favicons/favicon.ico') }}">
    <link rel="manifest" href='{{ asset('assetsindex/img/favicons/manifest.json') }}'>

    {{-- arquivo admin/header  --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assetsindex/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href='{{ asset('assetsindex/img/favicons/favicon-32x32.png') }}'>
    <link rel="icon" type="image/png" sizes="16x16"
        href='{{ asset('assetsindex/img/favicons/favicon-16x16.png') }}'>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsindex/img/favicons/favicon.ico') }}">
    <link rel="manifest" href='{{ asset('assetsindex/img/favicons/manifest.json') }}'>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <title>Perfil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('build/assets/app-27abf3b7.css') }}" rel="stylesheet">
    <script src="{{ asset('build/assets/app-9bd023a7.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-dark-100 light:bg-dark-900">
        @include('layouts.admin.header')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow light:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @include('layouts.admin.scripts')
    <!-- Bootstrap JS Bundle (inclui Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
