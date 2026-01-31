@extends('layout')

@section('title', 'Members')

@section('content')
<div class="page-header">
    <h2>👥 Members</h2>
    <a href="{{ route('members.create') }}" class="btn btn-primary">+ Add New Member</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Borrowings</th>
                    <th>Fines</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td><strong>{{ $member->member_id }}</strong></td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td><span class="badge badge-info">{{ ucfirst($member->member_type) }}</span></td>
                    <td>
                        @if($member->status === 'active')
                            <span class="badge badge-success">Active</span>
                        @elseif($member->status === 'inactive')
                            <span class="badge badge-secondary">Inactive</span>
                        @else
                            <span class="badge badge-danger">Suspended</span>
                        @endif
                    </td>
                    <td>{{ $member->borrowings_count }}</td>
                    <td>{{ $member->fines_count }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('members.destroy', $member) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="empty-state">
                        <p>No members found</p>
                        <a href="{{ route('members.create') }}" class="btn btn-primary">Add Your First Member</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $members->links() }}
</div>
@endsection