<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'ID_city';
    public $timestamps = true;

    protected $fillable = [
        'city_name',
    ];


  

 
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'ID_city', 'ID_city');
    }
}