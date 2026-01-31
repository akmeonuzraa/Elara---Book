@extends('layout')

@section('title', 'New Reservation')

@section('content')
<div class="page-header">
    <h2>New Reservation</h2>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">← Back to Reservations</a>
</div>

<div class="card">
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="book_id">Book *</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">Select Book</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} - {{ $book->author->name }}
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

        <div class="alert alert-info">
            <strong>Note:</strong> Reservation will expire in 7 days if not fulfilled.
        </div>

        <button type="submit" class="btn btn-primary">Create Reservation</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection