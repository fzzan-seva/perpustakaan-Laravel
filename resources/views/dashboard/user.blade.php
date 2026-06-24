@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="stat-grid">
    <div class="stat-card stat-indigo">
        <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
        <div class="stat-value">{{ $stats['active_borrows'] }}</div>
        <div class="stat-label">Sedang Dipinjam</div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
        <div class="stat-value">{{ $stats['returned'] }}</div>
        <div class="stat-label">Sudah Dikembalikan</div>
    </div>
    <div class="stat-card stat-amber">
        <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
        <div class="stat-value">{{ $stats['pending'] }}</div>
        <div class="stat-label">Menunggu Persetujuan</div>
    </div>
</div>

@if($myBorrows->isNotEmpty())
<div class="card-panel mb-4">
    <div class="card-panel-header">
        <h3><i class="bi bi-clock-history me-2"></i>Peminjaman Terakhir</h3>
        <a href="{{ route('borrows.index') }}" class="btn-outline-custom btn-sm">Lihat Semua</a>
    </div>
    <div class="card-panel-body p-0">
        <table class="custom-table">
            <thead>
                <tr><th>Buku</th><th>Status</th><th>Jatuh Tempo</th></tr>
            </thead>
            <tbody>
                @foreach($myBorrows as $borrow)
                <tr>
                    <td><strong>{{ $borrow->book->title }}</strong></td>
                    <td><span class="badge-status badge-{{ $borrow->status_color }}">{{ $borrow->status_label }}</span></td>
                    <td>{{ $borrow->due_date?->format('d M Y') ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<div class="card-panel-header mb-3" style="background:none;border:none;padding:0;">
    <h3 style="font-size:1.2rem;font-weight:700;"><i class="bi bi-stars me-2"></i>Rekomendasi Buku</h3>
    <a href="{{ route('books.index') }}" class="btn-outline-custom btn-sm">Lihat Katalog</a>
</div>

<div class="book-grid">
    @foreach($featuredBooks as $book)
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
@endsection
