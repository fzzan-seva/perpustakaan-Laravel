@extends('layouts.app')

@section('title', 'Peminjaman Saya')
@section('page-title', 'Peminjaman Saya')

@section('content')
<div class="card-panel">
    <div class="card-panel-body p-0">
        @if($borrows->isEmpty())
            <div class="empty-state">
                <i class="bi bi-journal-x"></i>
                <p>Anda belum meminjam buku apapun.</p>
                <a href="{{ route('books.index') }}" class="btn-primary-custom mt-2"><i class="bi bi-book"></i> Jelajahi Katalog</a>
            </div>
        @else
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Kategori</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrows as $borrow)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $borrow->book->cover_url }}" alt="" style="width:40px;height:56px;object-fit:cover;border-radius:6px;">
                            <strong>{{ $borrow->book->title }}</strong>
                        </div>
                    </td>
                    <td>{{ $borrow->book->category->name }}</td>
                    <td>{{ $borrow->borrow_date?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $borrow->due_date?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $borrow->return_date?->format('d M Y') ?? '-' }}</td>
                    <td><span class="badge-status badge-{{ $borrow->status_color }}">{{ $borrow->status_label }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $borrows->links() }}</div>
        @endif
    </div>
</div>
@endsection
