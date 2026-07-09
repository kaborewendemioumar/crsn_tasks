<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\LivrableController;
use App\Http\Controllers\RapportController;

Route::get('/', function () {
    return view('welcome');
});

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
    Route::resource(
        'users',
        UserController::class
    );

    

    Route::resource(
        'livrables',
        LivrableController::class
    );

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
    Route::resource(
        'rapports',
        RapportController::class
    );

});
Route::get('/bienvenue', function () {
    return view('bienvenue');
})->middleware('auth')->name('bienvenue');

require __DIR__.'/auth.php';