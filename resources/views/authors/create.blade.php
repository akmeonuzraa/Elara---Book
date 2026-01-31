@extends('layout')

@section('title', 'Add New Author')

@section('content')
<div class="page-header">
    <h2>Add New Author</h2>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to Authors</a>
</div>

<div class="card">
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ old('nationality') }}">
        </div>

        <div class="form-group">
            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
        </div>

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" class="form-control">{{ old('biography') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection