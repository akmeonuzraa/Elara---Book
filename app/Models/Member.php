<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'email',
        'phone',
        'address',
        'member_type',
        'membership_date',
        'expiry_date',
        'status',
        'photo'
    ];

    protected $casts = [
        'membership_date' => 'date',
        'expiry_date' => 'date'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)->where('status', 'borrowed');
    }

    public function hasOverdueFines()
    {
        return $this->fines()->where('status', 'unpaid')->exists();
    }
}