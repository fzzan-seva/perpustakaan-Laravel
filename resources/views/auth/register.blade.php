@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')
<h2>Buat Akun</h2>
<p class="subtitle">Daftar sebagai siswa perpustakaan sekolah</p>

@if($errors->any())
    <div class="alert alert-danger custom-alert mb-4">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label-custom">Nama Lengkap</label>
        <input type="text" name="name" class="form-control-custom" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label-custom">Email</label>
        <input type="email" name="email" class="form-control-custom" value="{{ old('email') }}" required>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label-custom">Kelas</label>
            <input type="text" name="class" class="form-control-custom" value="{{ old('class') }}" placeholder="XII IPA 1">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label-custom">No. Telepon</label>
            <input type="text" name="phone" class="form-control-custom" value="{{ old('phone') }}">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label-custom">Password</label>
        <input type="password" name="password" class="form-control-custom" required>
    </div>
    <div class="mb-4">
        <label class="form-label-custom">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control-custom" required>
    </div>
    <button type="submit" class="btn-primary-custom w-100 justify-content-center py-3">
        <i class="bi bi-person-plus-fill"></i> Daftar
    </button>
</form>

<p class="text-center mt-4 mb-0" style="font-size:0.9rem;">
    Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
</p>
@endsection
