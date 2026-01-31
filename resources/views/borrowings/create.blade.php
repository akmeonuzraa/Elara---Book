@extends('layout')

@section('title', 'New Borrowing')

@section('content')
<div class="page-header">
    <h2>New Borrowing</h2>
    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">← Back to Borrowings</a>
</div>

<div class="card">
    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="book_id">Book *</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">Select Book</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} ({{ $book->available_copies }} available)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="member_id">Member *</label>
            <select name="member_id" id="member_id" class="form-control" required>
                <option value="">Select Member</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }} ({{ $member->member_id }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="detail-grid">
            <div class="form-group">
                <label for="borrow_date">Borrow Date *</label>
                <input type="date" name="borrow_date" id="borrow_date" class="form-control" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date *</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Borrowing</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection