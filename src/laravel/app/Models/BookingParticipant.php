<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingParticipant extends Model
{
    use HasFactory;

    protected $table = 'booking_participants';
    protected $primaryKey = 'ID_booking_participant';
    public $timestamps = true;

    protected $fillable = [
        'ID_personnel',
        'ID_booking',
        'status'
    ];

 
    public function personnel(): BelongsTo
    {
        return $this->belongsTo(Personnel::class, 'ID_personnel', 'ID_personnel');
    }

    
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'ID_booking', 'ID_booking');
    }
}