@extends('layout')

@section('title', $author->name)

@section('content')
<div class="page-header">
    <h2>{{ $author->name }}</h2>
    <div class="actions">
        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="card">
    <h3>Author Information</h3>
    
    <div class="detail-item">
        <label>Name</label>
        <p>{{ $author->name }}</p>
    </div>

    <div class="detail-item">
        <label>Nationality</label>
        <p>{{ $author->nationality ?? 'N/A' }}</p>
    </div>

    <div class="detail-item">
        <label>Birth Date</label>
        <p>{{ $author->birth_date ? $author->birth_date->format('M d, Y') : 'N/A' }}</p>
    </div>

    @if($author->biography)
    <div class="detail-item">
        <label>Biography</label>
        <p>{{ $author->biography }}</p>
    </div>
    @endif
</div>

<div class="card">
    <h3>Books by {{ $author->name }} ({{ $author->books->count() }})</h3>
    
    @if($author->books->count() > 0)
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($author->books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
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
    <p class="empty-state">No books by this author yet</p>
    @endif
</div>
@endsection