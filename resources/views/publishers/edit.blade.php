@extends('layout')

@section('title', 'Edit Publisher')

@section('content')
<div class="page-header">
    <h2>Edit Publisher: {{ $publisher->name }}</h2>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary">← Back to Publishers</a>
</div>

<div class="card">
    <form action="{{ route('publishers.update', $publisher) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $publisher->name) }}" required>
        </div>

        <div class="detail-grid">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $publisher->email) }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $publisher->phone) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $publisher->website) }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $publisher->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Publisher</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection