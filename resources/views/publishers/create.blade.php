@extends('layout')

@section('title', 'Add New Publisher')

@section('content')
<div class="page-header">
    <h2>Add New Publisher</h2>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary">← Back to Publishers</a>
</div>

<div class="card">
    <form action="{{ route('publishers.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="detail-grid">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ old('website') }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Publisher</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection