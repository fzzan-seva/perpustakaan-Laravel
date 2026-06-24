@extends('layouts.app')

@section('title', $book->title)
@section('page-title', 'Detail Buku')

@section('breadcrumb')
<a href="{{ route('books.index') }}" style="color:#6366f1;text-decoration:none;">Katalog</a> / {{ Str::limit($book->title, 40) }}
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card-panel overflow-hidden">
            <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" style="width:100%;height:400px;object-fit:cover;">
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-panel">
            <div class="card-panel-body">
                <span class="badge-status mb-3" style="background:{{ $book->category->color }}20;color:{{ $book->category->color }}">{{ $book->category->name }}</span>
                <h2 style="font-weight:800;margin-bottom:8px;">{{ $book->title }}</h2>
                <p style="color:#64748b;font-size:1.1rem;margin-bottom:24px;">oleh <strong>{{ $book->author }}</strong></p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div style="font-size:0.8rem;color:#64748b;">ISBN</div>
                        <strong>{{ $book->isbn }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <div style="font-size:0.8rem;color:#64748b;">Penerbit</div>
                        <strong>{{ $book->publisher ?? '-' }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <div style="font-size:0.8rem;color:#64748b;">Tahun Terbit</div>
                        <strong>{{ $book->published_year ?? '-' }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <div style="font-size:0.8rem;color:#64748b;">Lokasi Rak</div>
                        <strong>{{ $book->location ?? '-' }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <div style="font-size:0.8rem;color:#64748b;">Ketersediaan</div>
                        <span class="stock-badge {{ $book->isAvailable() ? 'stock-available' : 'stock-empty' }}">
                            {{ $book->available }} dari {{ $book->stock }} tersedia
                        </span>
                    </div>
                </div>

                @if($book->description)
                <div class="mb-4">
                    <h5 style="font-weight:700;">Sinopsis</h5>
                    <p style="color:#475569;line-height:1.7;">{{ $book->description }}</p>
                </div>
                @endif

                @if($book->isAvailable())
                <form action="{{ route('books.borrow', $book) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary-custom py-3 px-4">
                        <i class="bi bi-journal-plus"></i> Ajukan Peminjaman
                    </button>
                </form>
                @else
                <button class="btn-outline-custom py-3 px-4" disabled>
                    <i class="bi bi-x-circle"></i> Tidak Tersedia
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
