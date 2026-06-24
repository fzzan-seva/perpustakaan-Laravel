@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Kelola Kategori')

@section('topbar-actions')
<a href="{{ route('admin.categories.create') }}" class="btn-primary-custom"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
@endsection

@section('content')
<div class="card-panel">
    <div class="card-panel-body p-0">
        @if($categories->isEmpty())
            <div class="empty-state"><i class="bi bi-tags"></i>Belum ada kategori</div>
        @else
        <table class="custom-table">
            <thead>
                <tr><th>Nama</th><th>Deskripsi</th><th>Jumlah Buku</th><th>Warna</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ Str::limit($category->description, 50) ?? '-' }}</td>
                    <td>{{ $category->books_count }}</td>
                    <td><span style="display:inline-block;width:24px;height:24px;border-radius:6px;background:{{ $category->color }};"></span></td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-sm-action" style="background:#eef2ff;color:#4338ca;"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori?')">
                            @csrf @method('DELETE')
                            <button class="btn-sm-action" style="background:#fee2e2;color:#991b1b;"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $categories->links() }}</div>
        @endif
    </div>
</div>
@endsection
