<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['book.author', 'member', 'issuedBy']);
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $borrowings = $query->latest()->paginate(15);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('available_copies', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        return view('borrowings.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable|string',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        
        if ($book->available_copies <= 0) {
            return back()->with('error', 'Book is not available!');
        }

        DB::transaction(function () use ($validated, $book) {
            $validated['issued_by'] = 1; // Default user ID, change when auth is ready
            $validated['status'] = 'borrowed';
            
            Borrowing::create($validated);
            
            $book->decrement('available_copies');
        });

        return redirect()->route('borrowings.index')->with('success', 'Book borrowed successfully!');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['book', 'member', 'issuedBy', 'returnedBy', 'fine']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return redirect()->route('borrowings.index')->with('error', 'Cannot edit returned borrowing!');
        }

        $books = Book::all();
        $members = Member::where('status', 'active')->get();
        return view('borrowings.edit', compact('borrowing', 'books', 'members'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        if ($request->has('return')) {
            return $this->returnBook($borrowing);
        }

        $validated = $request->validate([
            'due_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $borrowing->update($validated);

        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully!');
    }

    protected function returnBook(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            $borrowing->update([
                'return_date' => now(),
                'returned_by' => 1, // Default user ID
                'status' => 'returned'
            ]);

            $borrowing->book->increment('available_copies');

            // Calculate fine if overdue
            if (now()->greaterThan($borrowing->due_date)) {
                $daysOverdue = now()->diffInDays($borrowing->due_date);
                $fineAmount = $daysOverdue * 5; // 5 DH per day

                Fine::create([
                    'borrowing_id' => $borrowing->id,
                    'member_id' => $borrowing->member_id,
                    'amount' => $fineAmount,
                    'days_overdue' => $daysOverdue,
                    'status' => 'unpaid'
                ]);
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Book returned successfully!');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            return redirect()->route('borrowings.index')->with('error', 'Cannot delete active borrowing!');
        }
        
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Borrowing deleted successfully!');
    }
}