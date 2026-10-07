<?php

namespace App\Http\Controllers;
use App\Notifications\AccountActivated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'active' => 'nullable|boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'active' => $request->boolean('active', false)
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur ajouté.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',
        'active' => 'nullable|boolean'
    ]);

    // Mémoriser l'état avant modification
    $wasActive = $user->active;

    // Nouvel état demandé
    $newActive = $request->boolean('active', false);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'active' => $newActive
    ]);

    // Envoyer l'e-mail uniquement lors du passage
    // de compte inactif à compte actif
    if (!$wasActive && $newActive) {
        $user->notify(new AccountActivated());
    }

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur modifié.');
}
    public function updatePassword(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Vérifier que seul l'administrateur peut modifier le mot de passe
    if (auth()->user()->role !== 'administrateur') {
        abort(403, 'Accès non autorisé.');
    }

    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('users.edit', $user->id)
        ->with('success_password', 'Mot de passe modifié avec succès.');
}

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur supprimé.');
    }
}