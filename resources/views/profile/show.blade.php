@extends('layouts.app')

@section('title', 'Profil')
@section('page-title', 'Profil Saya')

@section('content')
<div class="profile-header">
    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
    <div>
        <h3 style="font-weight:800;margin:0;">{{ $user->name }}</h3>
        <p style="color:#64748b;margin:4px 0;">{{ $user->email }}</p>
        <span class="badge-status badge-primary">{{ $user->role_label }}</span>
        @if($user->class)
            <span class="badge-status badge-secondary ms-1">{{ $user->class }}</span>
        @endif
    </div>
</div>

<div class="form-panel">
    <h4 class="mb-4" style="font-weight:700;">Edit Profil</h4>

    @if($errors->any())
        <div class="alert alert-danger custom-alert mb-4">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Nama</label>
                <input type="text" name="name" class="form-control-custom" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control-custom" value="{{ old('email', $user->email) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">No. Telepon</label>
                <input type="text" name="phone" class="form-control-custom" value="{{ old('phone', $user->phone) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Kelas</label>
                <input type="text" name="class" class="form-control-custom" value="{{ old('class', $user->class) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label-custom">Foto Profil</label>
            <input type="file" name="avatar" class="form-control-custom" accept="image/*">
        </div>
        <hr class="my-4">
        <p style="font-size:0.875rem;color:#64748b;">Kosongkan jika tidak ingin mengubah password</p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Password Baru</label>
                <input type="password" name="password" class="form-control-custom">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control-custom">
            </div>
        </div>
        <button type="submit" class="btn-primary-custom mt-2">
            <i class="bi bi-check-lg"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection
