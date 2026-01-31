@extends('layout')

@section('title', 'Publishers')

@section('content')
<div class="page-header">
    <h2>🏢 Publishers</h2>
    <a href="{{ route('publishers.create') }}" class="btn btn-primary">+ Add New Publisher</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Books Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publishers as $publisher)
                <tr>
                    <td><strong>{{ $publisher->name }}</strong></td>
                    <td>{{ $publisher->email ?? 'N/A' }}</td>
                    <td>{{ $publisher->phone ?? 'N/A' }}</td>
                    <td>{{ $publisher->website ? Str::limit($publisher->website, 30) : 'N/A' }}</td>
                    <td><span class="badge badge-info">{{ $publisher->books_count }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('publishers.show', $publisher) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('publishers.destroy', $publisher) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <p>No publishers found</p>
                        <a href="{{ route('publishers.create') }}" class="btn btn-primary">Add Your First Publisher</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $publishers->links() }}
</div>
@endsection