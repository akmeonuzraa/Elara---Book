@extends('layout')

@section('title', 'Borrowings')

@section('content')
<div class="page-header">
    <h2>📋 Borrowings</h2>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary">+ New Borrowing</a>
</div>

<div class="filters">
    <form method="GET" action="{{ route('borrowings.index') }}">
        <div class="form-group">
            <label for="status">Filter by Status</label>
            <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Member</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                <tr>
                    {{-- <td><a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a></td>
                    <td><a href="{{ route('members.show', $borrowing->member) }}">{{ $borrowing->member->name }}</a></td> --}}
                    <td>
                        @if($borrowing->book)
                        <a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        @if($borrowing->member)
                        <a href="{{ route('members.show', $borrowing->member) }}">{{ $borrowing->member->name }}</a>
                        @else
                        N/A
                        @endif
                    </td>
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
                    <td>
                        <div class="actions">
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-info btn-sm">View</a>
                            @if($borrowing->status !== 'returned')
                                <a href="{{ route('borrowings.edit', $borrowing) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('borrowings.update', $borrowing) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="return" value="1">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Mark as returned?')">Return</button>
                                </form>
                            @endif
                        </div>
                    </td>
                    {{-- <td>
                        @if($borrowing->member)
                        <a href="{{ route('members.show', $borrowing->member) }}">{{ $borrowing->member->name }}</a>
                        @else
                        <span class="text-muted">No member assigned</span>
                        @endif
                    </td>
                    <td>
                        @if($borrowing->book)
                        <a href="{{ route('books.show', $borrowing->book) }}">{{ $borrowing->book->title }}</a>
                        @else
                        <span class="text-muted">No book assigned</span>
                        @endif
                    </td> --}}
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>No borrowings found</p>
                        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">Create First Borrowing</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $borrowings->links() }}
</div>
@endsection