@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="stat-grid">
    <div class="stat-card stat-indigo">
        <div class="stat-icon"><i class="bi bi-book-fill"></i></div>
        <div class="stat-value">{{ $stats['books'] }}</div>
        <div class="stat-label">Total Buku</div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="bi bi-tags-fill"></i></div>
        <div class="stat-value">{{ $stats['categories'] }}</div>
        <div class="stat-label">Kategori</div>
    </div>
    <div class="stat-card stat-cyan">
        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
        <div class="stat-value">{{ $stats['users'] }}</div>
        <div class="stat-label">Siswa Terdaftar</div>
    </div>
    <div class="stat-card stat-amber">
        <div class="stat-icon"><i class="bi bi-arrow-left-right"></i></div>
        <div class="stat-value">{{ $stats['borrows_active'] }}</div>
        <div class="stat-label">Sedang Dipinjam</div>
    </div>
    <div class="stat-card stat-red">
        <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
        <div class="stat-value">{{ $stats['borrows_pending'] }}</div>
        <div class="stat-label">Menunggu Persetujuan</div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card-panel">
            <div class="card-panel-header">
                <h3><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h3>
                <a href="{{ route('admin.borrows.index') }}" class="btn-outline-custom btn-sm">Lihat Semua</a>
            </div>
            <div class="card-panel-body p-0">
                @if($recentBorrows->isEmpty())
                    <div class="empty-state"><i class="bi bi-inbox"></i>Belum ada peminjaman</div>
                @else
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBorrows as $borrow)
                        <tr>
                            <td><strong>{{ $borrow->user->name }}</strong></td>
                            <td>{{ Str::limit($borrow->book->title, 30) }}</td>
                            <td><span class="badge-status badge-{{ $borrow->status_color }}">{{ $borrow->status_label }}</span></td>
                            <td>{{ $borrow->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card-panel">
            <div class="card-panel-header">
                <h3><i class="bi bi-fire me-2"></i>Buku Populer</h3>
            </div>
            <div class="card-panel-body">
                @foreach($popularBooks as $book)
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <img src="{{ $book->cover_url }}" alt="" style="width:48px;height:64px;object-fit:cover;border-radius:8px;">
                    <div class="flex-grow-1">
                        <strong style="font-size:0.9rem;">{{ $book->title }}</strong>
                        <div style="font-size:0.8rem;color:#64748b;">{{ $book->author }}</div>
                    </div>
                    <span class="badge-status badge-primary">{{ $book->borrows_count }}x</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
