<?php

namespace Tests\Feature;

use App\Models\Rapport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RapportAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_edit_a_submitted_report(): void
    {
        $user = User::factory()->create([
            'role' => 'utilisateur',
        ]);

        $rapport = Rapport::create([
            'user_id' => $user->id,
            'titre' => 'Rapport test',
            'contenu' => 'Contenu test',
            'date_rapport' => '2026-08-02',
            'statut' => 'Soumis',
        ]);

        $response = $this->actingAs($user)
            ->get(route('rapports.edit', $rapport));

        $response->assertForbidden();
    }
}
