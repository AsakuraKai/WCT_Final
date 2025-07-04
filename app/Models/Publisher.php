<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'founded_year',
        'headquarters',
        'website_url'
    ];

    protected $casts = [
        'founded_year' => 'integer'
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
