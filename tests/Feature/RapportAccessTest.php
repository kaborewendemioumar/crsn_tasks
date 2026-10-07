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

    public function test_user_can_correct_a_rejected_report_and_resubmit_it(): void
    {
        $user = User::factory()->create([
            'role' => 'utilisateur',
        ]);

        $rapport = Rapport::create([
            'user_id' => $user->id,
            'titre' => 'Rapport rejeté',
            'contenu' => 'Ancien contenu',
            'date_rapport' => '2026-08-02',
            'statut' => 'Rejeté',
            'commentaire_validation' => 'À corriger',
        ]);

        $response = $this->actingAs($user)
            ->put(route('rapports.update', $rapport), [
                'titre' => 'Rapport corrigé',
                'contenu' => 'Nouveau contenu',
                'date_rapport' => '2026-08-03',
            ]);

        $response->assertRedirect(route('rapports.index'));

        $this->assertDatabaseHas('rapports', [
            'id' => $rapport->id,
            'titre' => 'Rapport corrigé',
            'statut' => 'Soumis',
            'commentaire_validation' => null,
        ]);
    }

    public function test_validation_requires_a_comment(): void
    {
        $manager = User::factory()->create([
            'role' => 'manager',
        ]);

        $rapport = Rapport::create([
            'user_id' => $manager->id,
            'titre' => 'Rapport à valider',
            'contenu' => 'Contenu',
            'date_rapport' => '2026-08-02',
            'statut' => 'Soumis',
        ]);

        $response = $this->actingAs($manager)
            ->post(route('rapports.valider', $rapport), []);

        $response->assertSessionHasErrors('commentaire_validation');
        $this->assertDatabaseHas('rapports', [
            'id' => $rapport->id,
            'statut' => 'Soumis',
        ]);
    }
}
