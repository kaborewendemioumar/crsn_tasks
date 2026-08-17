<x-app-layout>

<div class="p-6">

<h2>Modifier utilisateur</h2>

<form
action="{{ route('users.update',$user->id) }}"
method="POST">

@csrf
@method('PUT')

<input
type="text"
name="name"
value="{{ $user->name }}"
required>

<br><br>

<input
type="email"
name="email"
value="{{ $user->email }}"
required>

<br><br>

<select name="role">

<option value="administrateur"
{{ $user->role=='administrateur' ? 'selected' : '' }}>
Administrateur
</option>

<option value="manager"
{{ $user->role=='manager' ? 'selected' : '' }}>
Manager
</option>

<option value="utilisateur"
{{ $user->role=='utilisateur' ? 'selected' : '' }}>
Utilisateur
</option>

</select>

<br><br>

<label>
    <input type="checkbox" name="active" value="1" {{ $user->active ? 'checked' : '' }}>
    Activer le compte
</label>

<br><br>

<button
style="background:orange;color:white;padding:10px;">
Modifier
</button>

</form>

<hr style="margin:30px 0;">


    {{-- MODIFICATION DU MOT DE PASSE --}}

    @if(auth()->user()->role === 'administrateur')

        <button
            type="button"
            onclick="afficherMotDePasse()"
            style="
                background:#2563eb;
                color:white;
                padding:10px 15px;
                border:none;
                border-radius:5px;
                cursor:pointer;">

            🔐 Modifier le mot de passe

        </button>


        <div
            id="formMotDePasse"
            style="
                display:none;
                margin-top:20px;
                padding:20px;
                border:1px solid #ddd;
                border-radius:8px;
                background:#f9fafb;">

            <h3 style="font-size:18px;font-weight:bold;margin-bottom:15px;">
                Modifier le mot de passe de {{ $user->name }}
            </h3>


            <form
                action="{{ route('users.updatePassword', $user->id) }}"
                method="POST">

                @csrf
                @method('PUT')


                <label>
                    <strong>Nouveau mot de passe</strong>
                </label>

                <br>

                <input
                    type="password"
                    name="password"
                    required
                    minlength="6"
                    style="
                        width:100%;
                        padding:8px;
                        margin-top:5px;">

                <br><br>


                <label>
                    <strong>Confirmer le nouveau mot de passe</strong>
                </label>

                <br>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="6"
                    style="
                        width:100%;
                        padding:8px;
                        margin-top:5px;">

                <br><br>


                @if($errors->any())
                    <div style="
                        color:#dc2626;
                        margin-bottom:15px;">

                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>
                @endif


                <button
                    type="submit"
                    style="
                        background:#16a34a;
                        color:white;
                        padding:10px 15px;
                        border:none;
                        border-radius:5px;
                        cursor:pointer;">

                    💾 Enregistrer le nouveau mot de passe

                </button>

            </form>

        </div>

    @endif

</div>


<script>

function afficherMotDePasse()
{
    const formulaire = document.getElementById('formMotDePasse');

    if (formulaire.style.display === 'none') {

        formulaire.style.display = 'block';

    } else {

        formulaire.style.display = 'none';

    }
}

</script>

</x-app-layout>

