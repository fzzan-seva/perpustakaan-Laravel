<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrow::with(['user', 'book']);

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('book', fn ($b) => $b->where('title', 'like', "%{$search}%"));
            });
        }

        $borrows = $query->latest()->paginate(10)->withQueryString();

        return view('admin.borrows.index', compact('borrows'));
    }

    public function approve(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak dapat disetujui.');
        }

        if (! $borrow->book->isAvailable()) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        $borrow->update([
            'status' => 'approved',
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        $borrow->book->decrement('available');

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak dapat ditolak.');
        }

        $borrow->update(['status' => 'rejected']);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function returnBook(Borrow $borrow)
    {
        if (! in_array($borrow->status, ['approved', 'overdue'])) {
            return back()->with('error', 'Buku tidak dalam status dipinjam.');
        }

        $borrow->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        $borrow->book->increment('available');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    public function destroy(Borrow $borrow)
    {
        if ($borrow->status === 'approved') {
            $borrow->book->increment('available');
        }

        $borrow->delete();

        return back()->with('success', 'Data peminjaman dihapus.');
    }
}
