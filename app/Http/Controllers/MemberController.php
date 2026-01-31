<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::withCount(['borrowings', 'fines'])->paginate(15);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'member_type' => 'required|in:student,teacher,staff,public',
        ]);

        $validated['member_id'] = 'MEM' . str_pad(Member::count() + 1, 5, '0', STR_PAD_LEFT);
        $validated['membership_date'] = now();
        $validated['expiry_date'] = now()->addYear();
        $validated['status'] = 'active';

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member created successfully!');
    }

    public function show(Member $member)
    {
        $member->load(['borrowings.book', 'fines.borrowing']);
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'member_type' => 'required|in:student,teacher,staff,public',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy(Member $member)
    {
        if ($member->borrowings()->where('status', 'borrowed')->count() > 0) {
            return redirect()->route('members.index')->with('error', 'Cannot delete member with active borrowings!');
        }
        
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
}