{{-- @extends('layout')

@section('title', 'Borrowing Details')

@section('content')
<div class="page-header">
    <h2>Borrowing Details</h2>
    <div class="actions">
        @if($borrowing->status !== 'returned')
            <form action="{{ route('borrowings.update', $borrowing) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="return" value="1">
                <button type="submit" class="btn btn-success" onclick="return confirm('Mark as returned?')">Return Book</button>
            </form>
        @endif
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h3>Book Information</h3>
        
        <div class="detail-item">
            <label>Title</label>
            <p><a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a></p>
        </div>

        <div class="detail-item">
            <label>ISBN</label>
            <p>{{ $borrowing->book->isbn ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Author</label>
            <p>{{ $borrowing->book->author->name }}</p>
        </div>
    </div>

    <div class="card">
        <h3>Member Information</h3>
        
        <div class="detail-item">
            <label>Name</label>
            <p><a href="{{ route('members.show', $borrowing->member) }}">{{ $borrowing->member->name }}</a></p>
        </div>

        <div class="detail-item">
            <label>Member ID</label>
            <p>{{ $borrowing->member->member_id }}</p>
        </div>

        <div class="detail-item">
            <label>Email</label>
            <p>{{ $borrowing->member->email }}</p>
        </div>

        <div class="detail-item">
            <label>Phone</label>
            <p>{{ $borrowing->member->phone }}</p>
        </div>
    </div>
</div>

<div class="card">
    <h3>Borrowing Details</h3>
    
    <div class="detail-grid">
        <div>
            <div class="detail-item">
                <label>Borrow Date</label>
                <p>{{ $borrowing->borrow_date->format('M d, Y') }}</p>
            </div>

            <div class="detail-item">
                <label>Due Date</label>
                <p>{{ $borrowing->due_date->format('M d, Y') }}</p>
            </div>

            <div class="detail-item">
                <label>Return Date</label>
                <p>{{ $borrowing->return_date ? $borrowing->return_date->format('M d, Y') : 'Not returned yet' }}</p>
            </div>
        </div>

        <div>
            <div class="detail-item">
                <label>Status</label>
                <p>
                    @if($borrowing->status === 'borrowed')
                        <span class="badge badge-warning" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Borrowed</span>
                    @elseif($borrowing->status === 'returned')
                        <span class="badge badge-success" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Returned</span>
                    @else
                        <span class="badge badge-danger" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Overdue</span>
                    @endif
                </p>
            </div>

            <div class="detail-item">
                <label>Issued By</label>
                <p>{{ $borrowing->issuedBy->name }}</p>
            </div>

            @if($borrowing->returned_by)
            <div class="detail-item">
                <label>Returned By</label>
                <p>{{ $borrowing->returnedBy->name }}</p>
            </div>
            @endif
        </div>
    </div>

    @if($borrowing->notes)
    <div class="detail-item">
        <label>Notes</label>
        <p>{{ $borrowing->notes }}</p>
    </div>
    @endif
</div>

@if($borrowing->fine)
<div class="card" style="border-left: 4px solid #dc3545;">
    <h3>Fine Information</h3>
    
    <div class="detail-grid">
        <div class="detail-item">
            <label>Amount</label>
            <p style="color: #dc3545; font-size: 1.5rem; font-weight: bold;">{{ number_format($borrowing->fine->amount, 2) }} DH</p>
        </div>

        <div class="detail-item">
            <label>Days Overdue</label>
            <p>{{ $borrowing->fine->days_overdue }} days</p>
        </div>

        <div class="detail-item">
            <label>Status</label>
            <p>
                @if($borrowing->fine->status === 'unpaid')
                    <span class="badge badge-danger">Unpaid</span>
                @elseif($borrowing->fine->status === 'paid')
                    <span class="badge badge-success">Paid</span>
                @else
                    <span class="badge badge-secondary">Waived</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endif
@endsection --}}



@extends('layout')

@section('title', 'Borrowing Details')

@section('content')
<div class="page-header">
    <h2>Borrowing Details</h2>
    <div class="actions">
        @if($borrowing->status !== 'returned')
            <form action="{{ route('borrowings.update', $borrowing) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="return" value="1">
                <button type="submit" class="btn btn-success" onclick="return confirm('Mark as returned?')">Return Book</button>
            </form>
        @endif
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h3>Book Information</h3>
        
        @if($borrowing->book)
        <div class="detail-item">
            <label>Title</label>
            <p><a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a></p>
        </div>

        <div class="detail-item">
            <label>ISBN</label>
            <p>{{ $borrowing->book->isbn ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Author</label>
            <p>{{ $borrowing->book->author->name ?? 'N/A' }}</p>
        </div>
        @else
        <p class="alert alert-error">Book information not available</p>
        @endif
    </div>

    <div class="card">
        <h3>Member Information</h3>
        
        @if($borrowing->member)
        <div class="detail-item">
            <label>Name</label>
            <p><a href="{{ route('members.show', $borrowing->member) }}">{{ $borrowing->member->name }}</a></p>
        </div>

        <div class="detail-item">
            <label>Member ID</label>
            <p>{{ $borrowing->member->member_id }}</p>
        </div>

        <div class="detail-item">
            <label>Email</label>
            <p>{{ $borrowing->member->email }}</p>
        </div>

        <div class="detail-item">
            <label>Phone</label>
            <p>{{ $borrowing->member->phone }}</p>
        </div>
        @else
        <p class="alert alert-error">Member information not available (Member may have been deleted)</p>
        @endif
    </div>
</div>

<div class="card">
    <h3>Borrowing Details</h3>
    
    <div class="detail-grid">
        <div>
            <div class="detail-item">
                <label>Borrow Date</label>
                <p>{{ $borrowing->borrow_date->format('M d, Y') }}</p>
            </div>

            <div class="detail-item">
                <label>Due Date</label>
                <p>{{ $borrowing->due_date->format('M d, Y') }}</p>
            </div>

            <div class="detail-item">
                <label>Return Date</label>
                <p>{{ $borrowing->return_date ? $borrowing->return_date->format('M d, Y') : 'Not returned yet' }}</p>
            </div>
        </div>

        <div>
            <div class="detail-item">
                <label>Status</label>
                <p>
                    @if($borrowing->status === 'borrowed')
                        <span class="badge badge-warning" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Borrowed</span>
                    @elseif($borrowing->status === 'returned')
                        <span class="badge badge-success" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Returned</span>
                    @else
                        <span class="badge badge-danger" style="font-size: 1.2rem; padding: 0.5rem 1rem;">Overdue</span>
                    @endif
                </p>
            </div>

            @if($borrowing->issuedBy)
            <div class="detail-item">
                <label>Issued By</label>
                <p>{{ $borrowing->issuedBy->name }}</p>
            </div>
            @endif

            @if($borrowing->returned_by && $borrowing->returnedBy)
            <div class="detail-item">
                <label>Returned By</label>
                <p>{{ $borrowing->returnedBy->name }}</p>
            </div>
            @endif
        </div>
    </div>

    @if($borrowing->notes)
    <div class="detail-item">
        <label>Notes</label>
        <p>{{ $borrowing->notes }}</p>
    </div>
    @endif
</div>

@if($borrowing->fine)
<div class="card" style="border-left: 4px solid #dc3545;">
    <h3>Fine Information</h3>
    
    <div class="detail-grid">
        <div class="detail-item">
            <label>Amount</label>
            <p style="color: #dc3545; font-size: 1.5rem; font-weight: bold;">{{ number_format($borrowing->fine->amount, 2) }} DH</p>
        </div>

        <div class="detail-item">
            <label>Days Overdue</label>
            <p>{{ $borrowing->fine->days_overdue }} days</p>
        </div>

        <div class="detail-item">
            <label>Status</label>
            <p>
                @if($borrowing->fine->status === 'unpaid')
                    <span class="badge badge-danger">Unpaid</span>
                @elseif($borrowing->fine->status === 'paid')
                    <span class="badge badge-success">Paid</span>
                @else
                    <span class="badge badge-secondary">Waived</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endif
@endsection