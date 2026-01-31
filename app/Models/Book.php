<?php

// namespace App\Models;

// use App\Models\Genre;
// use App\Models\Status;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Book extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'title',
//         'author',
//         'collection',
//         'ISBN',
//         'publication_date',
//         'number_of_pages',
//         'physical_place',
//         'content',
//         'genre_id',
//         'status_id'
//     ];

//     function genre(){
//         return $this->belongsTo(Genre::class);
//     }

//     function status(){
//         return $this->belongsTo(Status::class);
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'author_id',
        'publisher_id',
        'genre_id',
        'description',
        'publication_year',
        'language',
        'total_copies',
        'available_copies',
        'price',
        'cover_image',
        'pages',
        'edition'
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
        'price' => 'decimal:2',
        'pages' => 'integer'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable()
    {
        return $this->available_copies > 0;
    }
}