<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'statut',
        'user_id',
    ];

    /**
     * Un plan possède plusieurs tâches
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function synchroniserStatut(): void
    {
        if ($this->statut !== 'En attente') {
            return;
        }

        $nombreTaches = $this->tasks()->count();
        $nombreTachesTerminees = $this->tasks()
            ->where('statut', 'Terminée')
            ->count();

        if ($nombreTaches > 0 && $nombreTaches === $nombreTachesTerminees) {
            $this->update(['statut' => 'Terminé']);
        }
    }
}