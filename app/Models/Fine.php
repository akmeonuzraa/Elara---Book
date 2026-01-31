<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'member_id',
        'amount',
        'days_overdue',
        'status',
        'paid_date',
        'collected_by',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'days_overdue' => 'integer',
        'paid_date' => 'date'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function collectedBy()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }
}