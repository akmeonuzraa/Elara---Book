@extends('layout')

@section('title', $book->title)

@section('content')
<div class="page-header">
    <h2>{{ $book->title }}</h2>
    <div class="actions">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h3>Book Information</h3>
        
        <div class="detail-item">
            <label>Title</label>
            <p>{{ $book->title }}</p>
        </div>

        <div class="detail-item">
            <label>ISBN</label>
            <p>{{ $book->isbn ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Author</label>
            <p><a href="{{ route('authors.show', $book->author) }}">{{ $book->author->name }}</a></p>
        </div>

        <div class="detail-item">
            <label>Publisher</label>
            <p>{{ $book->publisher ? $book->publisher->name : 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Genre</label>
            <p><span class="badge badge-info">{{ $book->genre->name }}</span></p>
        </div>

        <div class="detail-item">
            <label>Publication Year</label>
            <p>{{ $book->publication_year ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Language</label>
            <p>{{ $book->language }}</p>
        </div>

        <div class="detail-item">
            <label>Pages</label>
            <p>{{ $book->pages ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Edition</label>
            <p>{{ $book->edition ?? 'N/A' }}</p>
        </div>

        <div class="detail-item">
            <label>Price</label>
            <p>{{ $book->price ? number_format($book->price, 2) . ' DH' : 'N/A' }}</p>
        </div>
    </div>

    <div class="card">
        <h3>Availability</h3>
        
        <div class="detail-item">
            <label>Total Copies</label>
            <p><strong>{{ $book->total_copies }}</strong></p>
        </div>

        <div class="detail-item">
            <label>Available Copies</label>
            <p>
                @if($book->available_copies > 0)
                    <span class="badge badge-success" style="font-size: 1.5rem; padding: 0.75rem 1.5rem;">{{ $book->available_copies }}</span>
                @else
                    <span class="badge badge-danger" style="font-size: 1.5rem; padding: 0.75rem 1.5rem;">Out of Stock</span>
                @endif
            </p>
        </div>

        <div class="detail-item">
            <label>Currently Borrowed</label>
            <p>{{ $book->total_copies - $book->available_copies }}</p>
        </div>
    </div>
</div>

@if($book->description)
<div class="card">
    <h3>Description</h3>
    <p>{{ $book->description }}</p>
</div>
@endif

<div class="card">
    <h3>Borrowing History</h3>
    
    @if($book->borrowings->count() > 0)
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book->borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->member->name }}</td>
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
@endsection