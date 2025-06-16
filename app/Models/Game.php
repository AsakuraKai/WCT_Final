<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'release_date',
        'publisher_id',
        'rating',
        'price',
        'is_active',
        'image_url',
        'steam_data',
        'steam_app_id',
        'is_from_steam'
    ];

    protected $casts = [
        'release_date' => 'date',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_active' => 'boolean',
        'is_from_steam' => 'boolean',
        'steam_data' => 'array'
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class, 'developer_game')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'game_platform')
                    ->withPivot('release_date')
                    ->withTimestamps();
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'game_genre')
                    ->withTimestamps();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
