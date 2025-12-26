<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'ID_Country';
    public $timestamps = true;

    protected $fillable = [
        'Country'
    ];

 

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'ID_Country', 'ID_Country');
    }
}
