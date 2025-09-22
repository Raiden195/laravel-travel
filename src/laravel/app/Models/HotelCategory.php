<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelCategory extends Model
{
    use HasFactory;

    protected $table = 'hotel_categories';
    protected $primaryKey = 'ID_hotel_categories';
    public $timestamps = true;

    protected $fillable = [
        'hotel_categories'
    ];

 
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'ID_hotel_categories', 'ID_hotel_categories');
    }
}