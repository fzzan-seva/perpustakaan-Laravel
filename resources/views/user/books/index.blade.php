@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@section('content')
<form class="search-bar" method="GET">
    <input type="text" name="search" class="form-control-custom" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
    <select name="category_id" class="form-control-custom" style="max-width:200px;">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary-custom"><i class="bi bi-search"></i> Cari</button>
</form>

@if($books->isEmpty())
    <div class="empty-state"><i class="bi bi-book"></i>Tidak ada buku ditemukan</div>
@else
<div class="book-grid">
    @foreach($books as $book)
    <a href="{{ route('books.show', $book) }}" class="book-card text-decoration-none text-dark">
        <div class="book-cover">
            <img src="{{ $book->cover_url }}" alt="{{ $book->title }}">
            <span class="book-category-tag" style="background:{{ $book->category->color }}">{{ $book->category->name }}</span>
        </div>
        <div class="book-info">
            <h4>{{ $book->title }}</h4>
            <div class="author">{{ $book->author }}</div>
            <div class="book-meta">
                <span class="stock-badge stock-available">{{ $book->available }} tersedia</span>
            </div>
        </div>
    </a>
    @endforeach
</div>
<div class="mt-4">{{ $books->links() }}</div>
@endif
@endsection
