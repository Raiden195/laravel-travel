<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'ID_role';
    public $timestamps = true;

    protected $fillable = [
        'Role',
        'Access'
    ];

 
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'ID_role', 'ID_role');
    }
}