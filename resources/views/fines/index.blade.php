@extends('layout')

@section('title', 'Fines')

@section('content')
<div class="page-header">
    <h2>💰 Fines</h2>
</div>

<div class="stats-grid">
    <div class="stat-card" style="border-left: 4px solid #dc3545;">
        <h4>Total Unpaid Fines</h4>
        <p style="color: #dc3545;">{{ number_format($totalUnpaid, 2) }} DH</p>
    </div>
</div>

<div class="filters">
    <form method="GET" action="{{ route('fines.index') }}">
        <div class="form-group">
            <label for="status">Filter by Status</label>
            <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="waived" {{ request('status') === 'waived' ? 'selected' : '' }}>Waived</option>
            </select>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Book</th>
                    <th>Days Overdue</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td><a href="{{ route('members.show', $fine->member) }}">{{ $fine->member->name }}</a></td>
                    <td><a href="{{ route('books.show', $fine->borrowing->book) }}">{{ $fine->borrowing->book->title }}</a></td>
                    <td>{{ $fine->days_overdue }} days</td>
                    <td><strong>{{ number_format($fine->amount, 2) }} DH</strong></td>
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
                    <td>
                        @if($fine->status === 'unpaid')
                        <div class="actions">
                            <form action="{{ route('fines.update', $fine) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="paid">
                                <button type="submit" class="btn btn-success btn-sm">Mark Paid</button>
                            </form>
                            <form action="{{ route('fines.update', $fine) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="waived">
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Waive this fine?')">Waive</button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>No fines found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $fines->links() }}
</div>
@endsection