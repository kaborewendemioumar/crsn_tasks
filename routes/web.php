

<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\LivrableController;
use App\Http\Controllers\RapportController;

Route::get('/account-pending', function () {
    return view('auth.account-pending');
})->name('account.pending');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aide', function () {

return view('aide.index');

})->name('aide');

Route::get('/aide/guide', function () {

return view('aide.guide');

})->name('aide.guide');

    

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

use App\Models\Plan;
use App\Models\Task;
use App\Models\Livrable;
use App\Models\Rapport;

Route::get('/dashboard', function () {

    return view('dashboard', [

        'plans' => Plan::count(),

        'tasks' => Task::count(),

        'tasks_attente' => Task::where(
            'statut',
            'En attente'
        )->count(),

        'tasks_terminees' => Task::where(
            'statut',
            'Terminée'
        )->count(),

        'tasks_retard' => Task::where('date_limite', '<', now())
            ->whereNotIn('statut', ['Terminée', 'Annulée'])
            ->count(),

        'livrables_soumis' => Livrable::where(
            'statut',
            'Soumis'
        )->count(),

        'livrables_valides' => Livrable::where(
            'statut',
            'Validé'
        )->count(),

        'rapports' => Rapport::count(),

    ]);

})->middleware(['auth'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| Profil utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Administrateur + Manager
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:administrateur,manager'
])->group(function () {

    Route::resource('plans', PlanController::class);

    Route::resource('tasks', TaskController::class);

    Route::resource(
        'task-assignments',
        TaskAssignmentController::class
    );

    

    // Voir la progression d'une affectation
Route::get(
    'task-assignments/{id}/progression',
    [TaskAssignmentController::class, 'progression']
)
->name('task-assignments.progression');

// Enregistrer ou modifier l'évaluation de progression
Route::post(
    'task-assignments/{id}/progression',
    [TaskAssignmentController::class, 'enregistrerProgression']
)
->name('task-assignments.enregistrerProgression');

    // Validation des livrables
    Route::post(
        'livrables/{livrable}/valider',
        [LivrableController::class, 'valider']
    )->name('livrables.valider');

    // Rejet des livrables
    Route::post(
        'livrables/{livrable}/rejeter',
        [LivrableController::class, 'rejeter']
    )->name('livrables.rejeter');

    // Validation des rapports
Route::post(
    'rapports/{rapport}/valider',
    [RapportController::class, 'valider']
)->name('rapports.valider');

    // Rejet des rapports
Route::post(
    'rapports/{rapport}/rejeter',
    [RapportController::class, 'rejeter']
)->name('rapports.rejeter');



});

/*
|--------------------------------------------------------------------------
| Administrateur
|--------------------------------------------------------------------------
*/


Route::middleware([
    'auth',
    'role:administrateur'
])->group(function () {

    Route::resource(
        'users',
        UserController::class
    );

    Route::put(
        'users/{id}/password',
        [UserController::class, 'updatePassword']
    )->name('users.updatePassword');

});

/*
|--------------------------------------------------------------------------
| Utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:utilisateur,administrateur,manager'
])->group(function () {

    Route::get(
        'mes-taches',
        [TaskAssignmentController::class, 'myTasks']
    )->name('task-assignments.my-tasks');

    



    Route::resource(
        'livrables',
        LivrableController::class
    );

    Route::get('livrables/{livrable}/download', [LivrableController::class, 'download'])
        ->name('livrables.download');

    Route::resource(
        'rapports',
        RapportController::class
    );

});
Route::get('/bienvenue', function () {
    return view('bienvenue');
})->middleware('auth')->name('bienvenue');

require __DIR__.'/auth.php';

