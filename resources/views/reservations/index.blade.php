@extends('layout')

@section('title', 'Reservations')

@section('content')
<div class="page-header">
    <h2>🔖 Reservations</h2>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">+ New Reservation</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Member</th>
                    <th>Reservation Date</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td><a href="{{ route('books.show', $reservation->book) }}">{{ $reservation->book->title }}</a></td>
                    <td><a href="{{ route('members.show', $reservation->member) }}">{{ $reservation->member->name }}</a></td>
                    <td>{{ $reservation->reservation_date->format('M d, Y') }}</td>
                    <td>{{ $reservation->expiry_date->format('M d, Y') }}</td>
                    <td>
                        @if($reservation->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($reservation->status === 'fulfilled')
                            <span class="badge badge-success">Fulfilled</span>
                        @elseif($reservation->status === 'cancelled')
                            <span class="badge badge-danger">Cancelled</span>
                        @else
                            <span class="badge badge-secondary">Expired</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            @if($reservation->status === 'pending')
                                <form action="{{ route('reservations.update', $reservation) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="fulfilled">
                                    <button type="submit" class="btn btn-success btn-sm">Fulfill</button>
                                </form>
                                <form action="{{ route('reservations.update', $reservation) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                                </form>
                            @endif
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display: inline;">
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
                        <p>No reservations found</p>
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary">Create First Reservation</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    {{ $reservations->links() }}
</div>
@endsection