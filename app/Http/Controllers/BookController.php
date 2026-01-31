<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'genre'])->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'publishers', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'language' => 'nullable|string|max:50',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'pages' => 'nullable|integer|min:1',
            'edition' => 'nullable|string|max:50',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'genre', 'borrowings.member']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'authors', 'publishers', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'language' => 'nullable|string|max:50',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'pages' => 'nullable|integer|min:1',
            'edition' => 'nullable|string|max:50',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}