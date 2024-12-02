<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Gudang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Auth::check())
                    <!-- Navbar link "Daftar Barang" tetap muncul -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Daftar Barang</a>
                    </li>

                    @if (Auth::user()->role == 'admin')
                    <!-- Admin dapat melihat link tambahan -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">Daftar Barang (Admin)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.checkout') }}">Aktivitas</a>
                    </li>
                    @else
                    <!-- User biasa hanya melihat "Aktivitas" -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.checkout') }}">Aktivitas</a>
                    </li>
                    @endif
                    @else
                    <!-- Jika tidak login, tampilkan hanya "Daftar Barang" -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Daftar Barang</a>
                    </li>
                    @endif
                </ul>

                <!-- Dropdown untuk akun user -->
                <!-- Dropdown untuk akun user -->
                <ul class="navbar-nav ms-auto">
                    @if (auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>




            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center mt-4">
        <p>&copy; {{ date('Y') }} Sistem Gudang. All rights reserved.</p>
    </footer>
</body>

</html>