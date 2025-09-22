<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnel';
    protected $primaryKey = 'ID_personnel';
    public $timestamps = true;

    protected $fillable = [
        'passport_series',
        'passport_number',
        'passport_issue_date',
        'passport_issued_who',
        'FIO'
    ];


    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'ID_personnel', 'ID_personnel');
    }

 
    public function bookingParticipants(): HasMany
    {
        return $this->hasMany(BookingParticipant::class, 'ID_personnel', 'ID_personnel');
    }
}