<?php

namespace Tests\Feature;

use App\Models\Livrable;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_links_to_livrable_history_sorted_by_submission_date(): void
    {
        $user = User::factory()->create([
            'role' => 'administrateur',
        ]);

        $plan = Plan::create([
            'titre' => 'Plan test',
            'description' => 'Plan de test',
            'date_debut' => '2026-09-01',
            'date_fin' => '2026-09-30',
            'statut' => 'En cours',
            'user_id' => $user->id,
        ]);

        $task = Task::create([
            'plan_id' => $plan->id,
            'titre' => 'Tâche test',
            'description' => 'Tâche de test',
            'priorite' => 'Moyenne',
            'statut' => 'En attente',
            'date_limite' => '2026-09-30',
        ]);

        $taskEnRetard = Task::create([
            'plan_id' => $plan->id,
            'titre' => 'Tâche en retard test',
            'description' => 'Tâche en retard de test',
            'priorite' => 'Moyenne',
            'statut' => 'En cours',
            'date_limite' => '2026-09-01',
        ]);

        $ancien = Livrable::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'fichier' => 'ancien.pdf',
            'statut' => 'Soumis',
            'date_soumission' => '2026-09-01 09:00:00',
        ]);

        $recent = Livrable::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'fichier' => 'recent.pdf',
            'statut' => 'Validé',
            'date_soumission' => '2026-09-08 09:00:00',
        ]);

        $dashboard = $this->actingAs($user)->get(route('dashboard'));

        $dashboard->assertOk()
            ->assertSee(route('plans.index'), false)
            ->assertSee(route('tasks.index'), false)
            ->assertSee(route('tasks.index', ['filter' => 'pending']), false)
            ->assertSee(route('tasks.index', ['filter' => 'overdue']), false)
            ->assertSee(route('tasks.index', ['filter' => 'completed']), false)
            ->assertSee(route('rapports.index'), false)
            ->assertSee(route('livrables.index', ['filter' => 'submitted']), false)
            ->assertSee(route('livrables.index', ['filter' => 'validated']), false)
            ->assertSee(route('livrables.index'), false);

        $this->actingAs($user)
            ->get(route('tasks.index', ['filter' => 'pending']))
            ->assertOk()
            ->assertSee($task->titre)
            ->assertDontSee($taskEnRetard->titre);

        $this->actingAs($user)
            ->get(route('tasks.index', ['filter' => 'overdue']))
            ->assertOk()
            ->assertSee($taskEnRetard->titre)
            ->assertDontSee($task->titre);

        $history = $this->actingAs($user)->get(route('livrables.index'));

        $history->assertOk()
            ->assertSee($recent->fichier)
            ->assertSee($ancien->fichier);

        $validatedHistory = $this->actingAs($user)
            ->get(route('livrables.index', ['filter' => 'validated']));

        $validatedHistory->assertOk()
            ->assertSee($recent->fichier)
            ->assertDontSee($ancien->fichier);

        $submittedHistory = $this->actingAs($user)
            ->get(route('livrables.index', ['filter' => 'submitted']));

        $submittedHistory->assertOk()
            ->assertSee($ancien->fichier)
            ->assertDontSee($recent->fichier);

        $this->assertLessThan(
            strpos($history->getContent(), $ancien->fichier),
            strpos($history->getContent(), $recent->fichier)
        );
    }
}
