<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'cell_phone',
        'password',
        'session_token',
        'completed_at',
    ];

    protected $hidden = [
        'password',
        'session_token',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function visits(): HasMany
    {
        return $this->hasMany(PlayerStoreVisit::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'player_store_visits')
            ->withPivot('visited_at')
            ->withTimestamps();
    }
}
