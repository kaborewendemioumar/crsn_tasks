
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateInitialAdminSeeder extends Seeder
{
    public function run(): void
    {
        $name = env('INITIAL_ADMIN_NAME');
        $email = env('INITIAL_ADMIN_EMAIL');
        $password = env('INITIAL_ADMIN_PASSWORD');

        if (!$name || !$email || !$password) {
            $this->command?->error(
                'Les variables de configuration de l’administrateur sont manquantes.'
            );
            return;
        }

        if (User::where('email', $email)->exists()) {
            $this->command?->error(
                'Cette adresse e-mail existe déjà. Aucun compte n’a été modifié.'
            );
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'administrateur',
            'active' => true,
        ]);

        $this->command?->info(
            'Administrateur principal créé avec succès.'
        );
    }
}
