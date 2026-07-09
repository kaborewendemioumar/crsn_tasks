<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Livrable extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'fichier',
        'commentaire',
        'statut',
        'date_soumission',
    ];

    /**
     * Le livrable appartient à une tâche
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Le livrable appartient à un utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}