@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<h2>Selamat Datang</h2>
<p class="subtitle">Masuk ke akun perpustakaan sekolah Anda</p>

@if($errors->any())
    <div class="alert alert-danger custom-alert mb-4">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label-custom">Email</label>
        <input type="email" name="email" class="form-control-custom" value="{{ old('email') }}" placeholder="nama@sekolah.sch.id" required autofocus>
    </div>
    <div class="mb-3">
        <label class="form-label-custom">Password</label>
        <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
    </div>
    <div class="mb-4 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
    </div>
    <button type="submit" class="btn-primary-custom w-100 justify-content-center py-3">
        <i class="bi bi-box-arrow-in-right"></i> Masuk
    </button>
</form>

<p class="text-center mt-4 mb-0" style="font-size:0.9rem;">
    Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
</p>

<div class="mt-4 p-3 rounded-3" style="background:#f8fafc;font-size:0.8rem;color:#64748b;">
    <strong>Demo:</strong><br>
    Admin: admin@perpus.sch.id / admin123<br>
    User: budi@student.sch.id / user123
</div>
@endsection
