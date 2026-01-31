@extends('layout')

@section('title', 'Authors')

@section('content')
<div class="page-header">
    <h2>✍️ Authors</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">+ Add New Author</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th>Birth Date</th>
                    <th>Books Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr>
                    <td><strong>{{ $author->name }}</strong></td>
                    <td>{{ $author->nationality ?? 'N/A' }}</td>
                    <td>{{ $author->birth_date ? $author->birth_date->format('M d, Y') : 'N/A' }}</td>
                    <td><span class="badge badge-info">{{ $author->books_count }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">
                        <p>No authors found</p>
                        <a href="{{ route('authors.create') }}" class="btn btn-primary">Add Your First Author</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $authors->links() }}
</div>
@endsection