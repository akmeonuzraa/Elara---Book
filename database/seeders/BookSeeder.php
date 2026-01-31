<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'isbn' => '9780747532699',
                'author_id' => 1,
                'publisher_id' => 1,
                'genre_id' => 9,
                'description' => 'First book in the Harry Potter series',
                'publication_year' => 1997,
                'language' => 'English',
                'total_copies' => 5,
                'available_copies' => 5,
                'pages' => 223
            ],
            [
                'title' => 'The Shining',
                'isbn' => '9780385121675',
                'author_id' => 2,
                'publisher_id' => 2,
                'genre_id' => 8,
                'description' => 'A horror novel by Stephen King',
                'publication_year' => 1977,
                'language' => 'English',
                'total_copies' => 3,
                'available_copies' => 3,
                'pages' => 447
            ],
            [
                'title' => 'Murder on the Orient Express',
                'isbn' => '9780062693662',
                'author_id' => 3,
                'publisher_id' => 3,
                'genre_id' => 8,
                'description' => 'Classic mystery novel',
                'publication_year' => 1934,
                'language' => 'English',
                'total_copies' => 4,
                'available_copies' => 4,
                'pages' => 256
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}