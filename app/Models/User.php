<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un utilisateur crée plusieurs plans
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    // Un utilisateur peut recevoir plusieurs affectations
    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }

    // Un utilisateur peut soumettre plusieurs livrables
    public function livrables()
    {
        return $this->hasMany(Livrable::class);
    }

    // Un utilisateur peut rédiger plusieurs rapports
    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }
}