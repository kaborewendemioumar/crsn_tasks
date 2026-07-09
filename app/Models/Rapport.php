<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rapport extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'contenu',
        'date_rapport',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}