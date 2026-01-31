@extends('layout')

@section('title', $member->name)

@section('content')
<div class="page-header">
    <h2>{{ $member->name }}</h2>
    <div class="actions">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h3>Member Information</h3>
        
        <div class="detail-item">
            <label>Member ID</label>
            <p><strong>{{ $member->member_id }}</strong></p>
        </div>

        <div class="detail-item">
            <label>Name</label>
            <p>{{ $member->name }}</p>
        </div>

        <div class="detail-item">
            <label>Email</label>
            <p>{{ $member->email }}</p>
        </div>

        <div class="detail-item">
            <label>Phone</label>
            <p>{{ $member->phone }}</p>
        </div>

        <div class="detail-item">
            <label>Member Type</label>
            <p><span class="badge badge-info">{{ ucfirst($member->member_type) }}</span></p>
        </div>

        <div class="detail-item">
            <label>Status</label>
            <p>
                @if($member->status === 'active')
                    <span class="badge badge-success">Active</span>
                @elseif($member->status === 'inactive')
                    <span class="badge badge-secondary">Inactive</span>
                @else
                    <span class="badge badge-danger">Suspended</span>
                @endif
            </p>
        </div>

        <div class="detail-item">
            <label>Address</label>
            <p>{{ $member->address ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="card">
        <h3>Membership Details</h3>
        
        <div class="detail-item">
            <label>Member Since</label>
            <p>{{ $member->membership_date->format('M d, Y') }}</p>
        </div>

        <div class="detail-item">
            <label>Expiry Date</label>
            <p>{{ $member->expiry_date ? $member->expiry_date->format('M d, Y') : 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Total Borrowings</label>
            <p><strong>{{ $member->borrowings->count() }}</strong></p>
        </div>

        <div class="detail-item">
            <label>Active Borrowings</label>
            <p><strong>{{ $member->borrowings->where('status', 'borrowed')->count() }}</strong></p>
        </div>

        <div class="detail-item">
            <label>Total Fines</label>
            <p><strong>{{ number_format($member->fines->sum('amount'), 2) }} DH</strong></p>
        </div>

        <div class="detail-item">
            <label>Unpaid Fines</label>
            <p><strong style="color: #dc3545;">{{ number_format($member->fines->where('status', 'unpaid')->sum('amount'), 2) }} DH</strong></p>
        </div>
    </div>
</div>

<div class="card">
    <h3>Borrowing History</h3>
    
    @if($member->borrowings->count() > 0)
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($member->borrowings as $borrowing)
                <tr>
                    <td><a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a></td>
                    <td>{{ $borrowing->borrow_date->format('M d, Y') }}</td>
                    <td>{{ $borrowing->due_date->format('M d, Y') }}</td>
                    <td>{{ $borrowing->return_date ? $borrowing->return_date->format('M d, Y') : '-' }}</td>
                    <td>
                        @if($borrowing->status === 'borrowed')
                            <span class="badge badge-warning">Borrowed</span>
                        @elseif($borrowing->status === 'returned')
                            <span class="badge badge-success">Returned</span>
                        @else
                            <span class="badge badge-danger">Overdue</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="empty-state">No borrowing history</p>
    @endif
</div>

@if($member->fines->count() > 0)
<div class="card">
    <h3>Fines</h3>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Amount</th>
                    <th>Days Overdue</th>
                    <th>Status</th>
                    <th>Paid Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($member->fines as $fine)
                <tr>
                    <td>{{ $fine->borrowing->book->title }}</td>
                    <td>{{ number_format($fine->amount, 2) }} DH</td>
                    <td>{{ $fine->days_overdue }}</td>
                    <td>
                        @if($fine->status === 'unpaid')
                            <span class="badge badge-danger">Unpaid</span>
                        @elseif($fine->status === 'paid')
                            <span class="badge badge-success">Paid</span>
                        @else
                            <span class="badge badge-secondary">Waived</span>
                        @endif
                    </td>
                    <td>{{ $fine->paid_date ? $fine->paid_date->format('M d, Y') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection