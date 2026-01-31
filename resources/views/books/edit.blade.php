@extends('layout')

@section('title', 'Edit Book')

@section('content')
<div class="page-header">
    <h2>Edit Book: {{ $book->title }}</h2>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
</div>

<div class="card">
    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="detail-grid">
            <div>
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                </div>

                <div class="form-group">
                    <label for="author_id">Author *</label>
                    <select name="author_id" id="author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="publisher_id">Publisher</label>
                    <select name="publisher_id" id="publisher_id" class="form-control">
                        <option value="">Select Publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="genre_id">Genre *</label>
                    <select name="genre_id" id="genre_id" class="form-control" required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="publication_year">Publication Year</label>
                    <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ old('publication_year', $book->publication_year) }}" min="1000" max="{{ date('Y') }}">
                </div>

                <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" name="language" id="language" class="form-control" value="{{ old('language', $book->language) }}">
                </div>

                <div class="form-group">
                    <label for="pages">Pages</label>
                    <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages', $book->pages) }}" min="1">
                </div>

                <div class="form-group">
                    <label for="edition">Edition</label>
                    <input type="text" name="edition" id="edition" class="form-control" value="{{ old('edition', $book->edition) }}">
                </div>

                <div class="form-group">
                    <label for="price">Price (DH)</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $book->price) }}" min="0">
                </div>
            </div>
        </div>

        <div class="detail-grid">
            <div class="form-group">
                <label for="total_copies">Total Copies *</label>
                <input type="number" name="total_copies" id="total_copies" class="form-control" value="{{ old('total_copies', $book->total_copies) }}" min="1" required>
            </div>

            <div class="form-group">
                <label for="available_copies">Available Copies *</label>
                <input type="number" name="available_copies" id="available_copies" class="form-control" value="{{ old('available_copies', $book->available_copies) }}" min="0" required>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $book->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection