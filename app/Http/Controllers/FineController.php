<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $query = Fine::with(['member', 'borrowing.book']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $fines = $query->latest()->paginate(15);
        $totalUnpaid = Fine::where('status', 'unpaid')->sum('amount');
        
        return view('fines.index', compact('fines', 'totalUnpaid'));
    }

    public function update(Request $request, Fine $fine)
    {
        $validated = $request->validate([
            'status' => 'required|in:unpaid,paid,waived',
        ]);

        if ($validated['status'] === 'paid') {
            $validated['paid_date'] = now();
            $validated['collected_by'] = 1; // Default user ID
        }

        $fine->update($validated);

        return redirect()->route('fines.index')->with('success', 'Fine updated successfully!');
    }
}