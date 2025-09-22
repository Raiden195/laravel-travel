<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'ID_booking';
    public $timestamps = true;

    protected $fillable = [
        'quantity_people',
        'booking_date',
        'start_date',
        'end_date',
        'booking_number',
        'ID_user',
        'ID_our',
        'total_cost'
    ];


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'ID_client', 'ID_client');
    }

  
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'ID_our', 'ID_tour');
    }

   
    public function participants(): HasMany
    {
        return $this->hasMany(BookingParticipant::class, 'ID_booking', 'ID_booking');
    }
}