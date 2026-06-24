<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = auth()->user()->borrows()
            ->with('book.category')
            ->latest()
            ->paginate(10);

        return view('user.borrows.index', compact('borrows'));
    }

    public function store(Request $request, Book $book)
    {
        if (! $book->isAvailable()) {
            return back()->with('error', 'Maaf, buku ini sedang tidak tersedia.');
        }

        $existing = auth()->user()->borrows()
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved', 'overdue'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda sudah meminjam atau mengajukan buku ini.');
        }

        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil diajukan. Menunggu persetujuan admin.');
    }
}
