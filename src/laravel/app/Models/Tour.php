<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $primaryKey = 'ID_tour';
    public $timestamps = true;

    protected $fillable = [
        'Name_tour',
        'Description_tour',
        'price',
        'Total_number_of_seats',
        'Available_seats',
        'photo',
        'Distance_to_the_beach',
        'Distance_to_the_airport',
        'Food',
        'Tour_status',
        'ID_tip_tour',
        'ID_Country',
        'ID_hotel_categories',
        'ID_city'
    ];

    public function tourType(): BelongsTo
    {
        return $this->belongsTo(TourType::class, 'ID_tip_tour', 'ID_tip_tour');
    }

    
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'ID_Country', 'ID_Country');
    }

    public function hotelCategory(): BelongsTo
    {
        return $this->belongsTo(HotelCategory::class, 'ID_hotel_categories', 'ID_hotel_categories');
    }


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'ID_city', 'ID_city');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'ID_our', 'ID_tour');
    }
}