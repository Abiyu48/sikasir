<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'SiKasir')</title>
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.navbar')

                <div class="container-fluid mt-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

    {{-- Ini penting untuk jalankan script yang dipush dari blade lain --}}
    @stack('scripts')
</body>
</html>
