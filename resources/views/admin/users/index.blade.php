@extends('layouts.app')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('topbar-actions')
<a href="{{ route('admin.users.create') }}" class="btn-primary-custom"><i class="bi bi-person-plus"></i> Tambah Pengguna</a>
@endsection

@section('content')
<form class="search-bar" method="GET">
    <input type="text" name="search" class="form-control-custom" placeholder="Cari nama atau email..." value="{{ request('search') }}">
    <select name="role" class="form-control-custom" style="max-width:160px;">
        <option value="">Semua Role</option>
        <option value="admin" @selected(request('role') == 'admin')>Admin</option>
        <option value="user" @selected(request('role') == 'user')>Siswa</option>
    </select>
    <button type="submit" class="btn-primary-custom"><i class="bi bi-search"></i> Cari</button>
</form>

<div class="card-panel">
    <div class="card-panel-body p-0">
        <table class="custom-table">
            <thead>
                <tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Kelas</th><th>Telepon</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $user->avatar_url }}" alt="" style="width:36px;height:36px;border-radius:10px;">
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge-status badge-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">{{ $user->role_label }}</span></td>
                    <td>{{ $user->class ?? '-' }}</td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm-action" style="background:#eef2ff;color:#4338ca;"><i class="bi bi-pencil"></i></a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengguna?')">
                            @csrf @method('DELETE')
                            <button class="btn-sm-action" style="background:#fee2e2;color:#991b1b;"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $users->links() }}</div>
    </div>
</div>
@endsection
