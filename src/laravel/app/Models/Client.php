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
        'ID_role',
        // Добавляем новые поля для активации
        'email_verified_at',
        'is_active',
        'email_verification_token'
    ];

    protected $hidden = [
        'password',
        'email_verification_token' // скрываем токен из JSON-ответов
    ];

    protected $casts = [
        'registration_date' => 'date',
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Указываем поле для аутентификации (логин)
    public function getAuthIdentifierName()
    {
        return 'login';
    }
     
    public function isActive(): bool
    {
        return true;
        // return $this->is_active && !is_null($this->email_verified_at);
    }

   
    public function activate(): void
    {
        $this->update([
            'is_active' => true,
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);
    }

    public function deactivate(): void
    {
        $this->update([
            'is_active' => false,
            'email_verification_token' => null,
        ]);
    }

    public function generateVerificationToken(): string
    {
        $token = \Illuminate\Support\Str::random(60);
        $this->update(['email_verification_token' => $token]);
        return $token;
    }

    public function isValidToken($token): bool
    {
        return hash_equals($this->email_verification_token, $token);
    }

    public function isTokenExpired($hours = 24): bool
    {
        if (!$this->email_verified_at) {
            return false; 
        }
    
        return false; 
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false)
                     ->orWhereNull('email_verified_at');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->whereNotNull('email_verified_at');
    }

    public function scopeByToken($query, $token)
    {
        return $query->where('email_verification_token', $token);
    }

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


    public function getActivationUrl(): string
    {
        return route('client.activate', ['token' => $this->email_verification_token]);
    }

    
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

   
    public function hasVerifiedEmail(): bool
    {
        return $this->isActive();
    }

    public function markEmailAsVerified(): void
    {
        $this->activate();
    }
}