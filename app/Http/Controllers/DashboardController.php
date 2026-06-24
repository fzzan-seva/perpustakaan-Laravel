<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'books' => Book::count(),
                'categories' => Category::count(),
                'users' => User::where('role', 'user')->count(),
                'borrows_active' => Borrow::whereIn('status', ['approved', 'overdue'])->count(),
                'borrows_pending' => Borrow::where('status', 'pending')->count(),
            ];

            $recentBorrows = Borrow::with(['user', 'book'])
                ->latest()
                ->take(5)
                ->get();

            $popularBooks = Book::with('category')
                ->withCount('borrows')
                ->orderByDesc('borrows_count')
                ->take(5)
                ->get();

            return view('dashboard.admin', compact('stats', 'recentBorrows', 'popularBooks'));
        }

        $stats = [
            'active_borrows' => $user->borrows()->whereIn('status', ['approved', 'overdue'])->count(),
            'returned' => $user->borrows()->where('status', 'returned')->count(),
            'pending' => $user->borrows()->where('status', 'pending')->count(),
        ];

        $myBorrows = $user->borrows()
            ->with('book.category')
            ->latest()
            ->take(5)
            ->get();

        $featuredBooks = Book::with('category')
            ->where('available', '>', 0)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('dashboard.user', compact('stats', 'myBorrows', 'featuredBooks'));
    }
}
