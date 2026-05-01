<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIntern - Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .nav-link {
            color: #000 !important;
        }

        .nav-link:hover {
            color: #000 !important;
        }

        .active-menu {
            background-color: #E7F5D2;
            color: #000 !important;
        }

        .nav-link {
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .input-group input:focus {
            box-shadow: none;
        }

        .input-group {
            border-radius: 20px;
            overflow: hidden;
        }

        header,
        .header {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content -->
        {{-- <div class="flex-grow-1">
            <div class="p-4">
                @yield('content')
            </div>
        </div> --}}

        {{-- </div> --}}

        <!-- Content Area -->
        <div class="flex-grow-1 d-flex flex-column">

            <!-- HEADER -->
            @include('layouts.header')

            <!-- MAIN CONTENT -->
            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>

        </div>
    </div>

        <!-- Footer -->
        @include('layouts.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
