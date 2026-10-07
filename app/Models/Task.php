<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Livrable;

class Task extends Model
{
    protected $fillable = [
        'plan_id',
        'titre',
        'description',
        'nombre_livrables_prevus',
        'priorite',
        'statut',
        'date_limite'
    ];

    /**
     * Une tâche appartient à un plan
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Une tâche peut être affectée à plusieurs utilisateurs
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(TaskAssignment::class);
    }

    /**
     * Une tâche peut avoir plusieurs livrables
     */
    public function livrables(): HasMany
    {
        return $this->hasMany(Livrable::class);
    }
}