<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\Fine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'available_books' => Book::where('available_copies', '>', 0)->count(),
            'total_members' => Member::where('status', 'active')->count(),
            'active_borrowings' => Borrowing::where('status', 'borrowed')->count(),
            'overdue_books' => Borrowing::where('status', 'overdue')->count(),
            'unpaid_fines' => Fine::where('status', 'unpaid')->sum('amount'),
        ];

        $recent_borrowings = Borrowing::with(['book', 'member'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_borrowings'));
    }
}