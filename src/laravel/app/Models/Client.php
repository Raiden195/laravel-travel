<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'clients';
    protected $primaryKey = 'ID_client';
    public $timestamps = true;

    protected $fillable = [
        'phone_number',
        'email',
        'registration_date',
        'ID_personnel', // это персональные данные для бронирования
        'login',
        'password',
        'ID_role'
    ];

    protected $hidden = [
        'password'
    ];

    // Указываем поле для аутентификации (логин)
    public function getAuthIdentifierName()
    {
        return 'login';
    }

    // Связь с персональными данными (паспортные данные)
    public function personnelData(): BelongsTo
    {
        return $this->belongsTo(Personnel::class, 'ID_personnel', 'ID_personnel');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'ID_role', 'ID_role');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'ID_client', 'ID_client');
    }
}