@extends('layout')

@section('title', 'Edit Borrowing')

@section('content')
<div class="page-header">
    <h2>Edit Borrowing</h2>
    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">← Back to Borrowings</a>
</div>

<div class="card">
    <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="book_id">Book *</label>
            <select name="book_id" id="book_id" class="form-control" required disabled>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="book_id" value="{{ $borrowing->book_id }}">
        </div>

        <div class="form-group">
            <label for="member_id">Member *</label>
            <select name="member_id" id="member_id" class="form-control" required disabled>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id', $borrowing->member_id) == $member->id ? 'selected' : '' }}>
                        {{ $member->name }} ({{ $member->member_id }})
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="member_id" value="{{ $borrowing->member_id }}">
        </div>

        <div class="detail-grid">
            <div class="form-group">
                <label for="borrow_date">Borrow Date</label>
                <input type="date" name="borrow_date" id="borrow_date" class="form-control" value="{{ $borrowing->borrow_date->format('Y-m-d') }}" disabled>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date *</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $borrowing->due_date->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes', $borrowing->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Borrowing</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection