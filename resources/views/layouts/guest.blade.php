<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="auth-body">
    <div class="auth-bg">
        <div class="auth-bg-shape shape-1"></div>
        <div class="auth-bg-shape shape-2"></div>
        <div class="auth-bg-shape shape-3"></div>
    </div>

    <div class="auth-container">
        <div class="auth-brand-panel d-none d-lg-flex">
            <div class="auth-brand-content">
                <div class="auth-logo"><i class="bi bi-book-half"></i></div>
                <h1>Perpustakaan<br>Sekolah Digital</h1>
                <p>Kelola dan pinjam buku dengan mudah. Sistem perpustakaan modern untuk sekolah Anda.</p>
                <div class="auth-features">
                    <div><i class="bi bi-check-circle-fill"></i> Katalog buku lengkap</div>
                    <div><i class="bi bi-check-circle-fill"></i> Peminjaman online</div>
                    <div><i class="bi bi-check-circle-fill"></i> Manajemen admin</div>
                </div>
            </div>
        </div>

        <div class="auth-form-panel">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
