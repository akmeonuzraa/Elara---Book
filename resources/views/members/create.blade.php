@extends('layout')

@section('title', 'Add New Member')

@section('content')
<div class="page-header">
    <h2>Add New Member</h2>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">← Back to Members</a>
</div>

<div class="card">
    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        
        <div class="detail-grid">
            <div>
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="member_type">Member Type *</label>
                    <select name="member_type" id="member_type" class="form-control" required>
                        <option value="student" {{ old('member_type') === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="teacher" {{ old('member_type') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="staff" {{ old('member_type') === 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="public" {{ old('member_type') === 'public' ? 'selected' : '' }}>Public</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Member</button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection