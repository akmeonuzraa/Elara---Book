@extends('layout')

@section('title', 'Edit Author')

@section('content')
<div class="page-header">
    <h2>Edit Author: {{ $author->name }}</h2>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to Authors</a>
</div>

<div class="card">
    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}" required>
        </div>

        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ old('nationality', $author->nationality) }}">
        </div>

        <div class="form-group">
            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $author->birth_date ? $author->birth_date->format('Y-m-d') : '') }}">
        </div>

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" class="form-control">{{ old('biography', $author->biography) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection