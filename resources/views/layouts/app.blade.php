<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon"><i class="bi bi-book-half"></i></div>
                <div>
                    <h1>Perpus</h1>
                    <span>Sekolah Digital</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <p class="nav-label">Menu Utama</p>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <i class="bi bi-collection-fill"></i> Katalog Buku
                </a>
                <a href="{{ route('borrows.index') }}" class="nav-link {{ request()->routeIs('borrows.index') ? 'active' : '' }}">
                    <i class="bi bi-journal-bookmark-fill"></i> Peminjaman Saya
                </a>

                @if(auth()->user()->isAdmin())
                <p class="nav-label mt-4">Administrasi</p>
                <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill"></i> Kelola Buku
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags-fill"></i> Kategori
                </a>
                <a href="{{ route('admin.borrows.index') }}" class="nav-link {{ request()->routeIs('admin.borrows.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Peminjaman
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Pengguna
                </a>
                @endif
            </nav>

            <div class="sidebar-profile">
                <a href="{{ route('profile.show') }}" class="profile-card">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="profile-avatar">
                    <div class="profile-info">
                        <strong>{{ auth()->user()->name }}</strong>
                        <span>{{ auth()->user()->role_label }}</span>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-left"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <button class="sidebar-toggle d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <div>
                    <h2 class="page-title">@yield('page-title', 'Dashboard')</h2>
                    @hasSection('breadcrumb')
                        <nav class="breadcrumb-nav">@yield('breadcrumb')</nav>
                    @endif
                </div>
                <div class="topbar-actions">
                    @yield('topbar-actions')
                </div>
            </header>

            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
