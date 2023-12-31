<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeatAllocation extends Model
{
    use HasFactory;

    protected $fillable = ['seat_number', 'ticket_id'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }


}
