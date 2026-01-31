<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'reservation_date',
        'expiry_date',
        'status'
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'expiry_date' => 'date'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function isExpired()
    {
        return now()->greaterThan($this->expiry_date) && $this->status === 'pending';
    }
}