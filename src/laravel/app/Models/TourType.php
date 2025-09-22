<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourType extends Model
{
    use HasFactory;

    protected $table = 'tour_types';
    protected $primaryKey = 'ID_tip_tour';
    public $timestamps = true;

    protected $fillable = [
        'tip_tour'
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'ID_tip_tour', 'ID_tip_tour');
    }
}