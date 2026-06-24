@extends('layouts.app')

@section('title', 'Kelola Peminjaman')
@section('page-title', 'Kelola Peminjaman')

@section('content')
<form class="search-bar" method="GET">
    <input type="text" name="search" class="form-control-custom" placeholder="Cari siswa atau buku..." value="{{ request('search') }}">
    <select name="status" class="form-control-custom" style="max-width:180px;">
        <option value="">Semua Status</option>
        @foreach(['pending'=>'Menunggu','approved'=>'Dipinjam','returned'=>'Dikembalikan','rejected'=>'Ditolak','overdue'=>'Terlambat'] as $val => $label)
            <option value="{{ $val }}" @selected(request('status') == $val)>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary-custom"><i class="bi bi-search"></i> Filter</button>
</form>

<div class="card-panel">
    <div class="card-panel-body p-0">
        @if($borrows->isEmpty())
            <div class="empty-state"><i class="bi bi-journal-x"></i>Belum ada peminjaman</div>
        @else
        <table class="custom-table">
            <thead>
                <tr><th>Siswa</th><th>Buku</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($borrows as $borrow)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $borrow->user->avatar_url }}" alt="" style="width:32px;height:32px;border-radius:8px;">
                            {{ $borrow->user->name }}
                        </div>
                    </td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->borrow_date?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $borrow->due_date?->format('d M Y') ?? '-' }}</td>
                    <td><span class="badge-status badge-{{ $borrow->status_color }}">{{ $borrow->status_label }}</span></td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            @if($borrow->status === 'pending')
                                <form action="{{ route('admin.borrows.approve', $borrow) }}" method="POST">@csrf @method('PATCH')
                                    <button class="btn-sm-action" style="background:#d1fae5;color:#065f46;" title="Setujui"><i class="bi bi-check-lg"></i></button>
                                </form>
                                <form action="{{ route('admin.borrows.reject', $borrow) }}" method="POST">@csrf @method('PATCH')
                                    <button class="btn-sm-action" style="background:#fee2e2;color:#991b1b;" title="Tolak"><i class="bi bi-x-lg"></i></button>
                                </form>
                            @endif
                            @if(in_array($borrow->status, ['approved', 'overdue']))
                                <form action="{{ route('admin.borrows.return', $borrow) }}" method="POST">@csrf @method('PATCH')
                                    <button class="btn-sm-action" style="background:#eef2ff;color:#4338ca;" title="Kembalikan"><i class="bi bi-arrow-return-left"></i></button>
                                </form>
                            @endif
                            <form action="{{ route('admin.borrows.destroy', $borrow) }}" method="POST" onsubmit="return confirm('Hapus data?')">@csrf @method('DELETE')
                                <button class="btn-sm-action" style="background:#f1f5f9;color:#475569;" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $borrows->links() }}</div>
        @endif
    </div>
</div>
@endsection
