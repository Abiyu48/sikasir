<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiKasir</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 70px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <div class="sidebar-brand-icon rotate-n-15 me-2">
        <i class="fas fa-cash-register"></i>
      </div>
      <div class="sidebar-brand-text">SiKasir</div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
      aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        @auth
        <!-- Dashboard -->
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>
        </li>

        <!-- Menu Khusus Admin -->
        @if(Auth::user()->role == 'admin')
          <!-- Data Master Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dataMasterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data Master
            </a>
            <ul class="dropdown-menu" aria-labelledby="dataMasterDropdown">
              <li><a class="dropdown-item" href="{{ route('kategori.index') }}"><i class="fas fa-list"></i> Kategori</a></li>
              <li><a class="dropdown-item" href="{{ route('menu.index') }}"><i class="fas fa-utensils"></i> Menu</a></li>
              <li><a class="dropdown-item" href="{{ route('customer.index') }}"><i class="fas fa-users"></i> Customer</a></li>
              <li><a class="dropdown-item" href="{{ route('user.index') }}"><i class="fas fa-user-cog"></i> Pengguna</a></li>
            </ul>
          </li>

          <!-- Stok Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="stokDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Stok
            </a>
            <ul class="dropdown-menu" aria-labelledby="stokDropdown">
              <li><a class="dropdown-item" href="{{ route('menu.index') }}"><i class="fas fa-boxes"></i> Entri Stok</a></li>
              <li><a class="dropdown-item" href="{{ route('stok.index') }}"><i class="fas fa-clipboard-list"></i> Daftar Stok</a></li>
            </ul>
          </li>

          <!-- Kasir -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
              <i class="fas fa-cash-register"></i> Kasir
            </a>
          </li>
        @endif

        <!-- Menu Khusus Kasir -->
        @if(Auth::user()->role == 'kasir')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
              <i class="fas fa-cash-register"></i> Kasir
            </a>
          </li>
        @endif

        <!-- Menu Khusus Owner -->
        @if(Auth::user()->role == 'owner')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.index') }}">
              <i class="fas fa-chart-line"></i> Laporan
            </a>
          </li>
        @endif
        @endauth
      </ul>

      <!-- Login / Logout -->
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> {{ ucfirst(Auth::user()->role) }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- End Navbar -->

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
