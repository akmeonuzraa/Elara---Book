@extends('layout')

@section('title', $publisher->name)

@section('content')
<div class="page-header">
    <h2>{{ $publisher->name }}</h2>
    <div class="actions">
        <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="card">
    <h3>Publisher Information</h3>
    
    <div class="detail-grid">
        <div>
            <div class="detail-item">
                <label>Name</label>
                <p>{{ $publisher->name }}</p>
            </div>

            <div class="detail-item">
                <label>Email</label>
                <p>{{ $publisher->email ?? 'N/A' }}</p>
            </div>

            <div class="detail-item">
                <label>Phone</label>
                <p>{{ $publisher->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div>
            <div class="detail-item">
                <label>Website</label>
                <p>
                    @if($publisher->website)
                        <a href="{{ $publisher->website }}" target="_blank">{{ $publisher->website }}</a>
                    @else
                        N/A
                    @endif
                </p>
            </div>

            <div class="detail-item">
                <label>Address</label>
                <p>{{ $publisher->address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h3>Books by {{ $publisher->name }} ({{ $publisher->books->count() }})</h3>
    
    @if($publisher->books->count() > 0)
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($publisher->books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->isbn ?? 'N/A' }}</td>
                    <td><span class="badge badge-info">{{ $book->genre->name }}</span></td>
                    <td>{{ $book->publication_year ?? 'N/A' }}</td>
                    <td>
                        @if($book->available_copies > 0)
                            <span class="badge badge-success">{{ $book->available_copies }}</span>
                        @else
                            <span class="badge badge-danger">0</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="empty-state">No books from this publisher yet</p>
    @endif
</div>
@endsection