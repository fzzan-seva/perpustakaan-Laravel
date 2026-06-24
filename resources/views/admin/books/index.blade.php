@extends('layouts.app')

@section('title', 'Kelola Buku')
@section('page-title', 'Kelola Buku')

@section('topbar-actions')
<a href="{{ route('admin.books.create') }}" class="btn-primary-custom"><i class="bi bi-plus-lg"></i> Tambah Buku</a>
@endsection

@section('content')
<form class="search-bar" method="GET">
    <input type="text" name="search" class="form-control-custom" placeholder="Cari judul, penulis, ISBN..." value="{{ request('search') }}">
    <select name="category_id" class="form-control-custom" style="max-width:200px;">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary-custom"><i class="bi bi-search"></i> Cari</button>
</form>

<div class="card-panel">
    <div class="card-panel-body p-0">
        @if($books->isEmpty())
            <div class="empty-state"><i class="bi bi-book"></i>Belum ada buku</div>
        @else
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td><img src="{{ $book->cover_url }}" alt="" style="width:40px;height:56px;object-fit:cover;border-radius:6px;"></td>
                        <td><strong>{{ $book->title }}</strong><br><small class="text-muted">{{ $book->isbn }}</small></td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge-status" style="background:{{ $book->category->color }}20;color:{{ $book->category->color }}">{{ $book->category->name }}</span></td>
                        <td>{{ $book->available }}/{{ $book->stock }}</td>
                        <td>{{ $book->location ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn-sm-action" style="background:#eef2ff;color:#4338ca;"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-sm-action" style="background:#fee2e2;color:#991b1b;"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $books->links() }}</div>
        @endif
    </div>
</div>
@endsection
