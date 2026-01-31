@extends('layout')

@section('title', 'Books')

@section('content')
<div class="page-header">
    <h2>📖 Books</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add New Book</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Copies</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->isbn ?? 'N/A' }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td><span class="badge badge-info">{{ $book->genre->name }}</span></td>
                    <td>{{ $book->total_copies }}</td>
                    <td>
                        @if($book->available_copies > 0)
                            <span class="badge badge-success">{{ $book->available_copies }}</span>
                        @else
                            <span class="badge badge-danger">0</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>No books found</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Your First Book</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $books->links() }}
</div>
@endsection