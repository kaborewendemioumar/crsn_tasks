<x-guest-layout>

    <!-- En-tête -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary mb-1">
            Mot de passe oublié ?
        </h2>

        <p class="text-muted mb-0">
            Réinitialisation de votre mot de passe
        </p>
    </div>

    <!-- Message d'information -->
    <div class="alert alert-info mb-4" role="alert">
        Entrez l'adresse e-mail associée à votre compte.
        Un lien de réinitialisation du mot de passe vous sera envoyé
        à cette adresse.
    </div>

    <!-- Message de session -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Adresse e-mail -->
        <div class="mb-4">
            <label
                for="email"
                class="form-label fw-semibold">
                Adresse e-mail
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                class="form-control"
                placeholder="Entrez votre adresse e-mail"
            >

            @error('email')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Bouton -->
        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-primary btn-lg">
                Envoyer le lien de réinitialisation
            </button>
        </div>

        <!-- Retour connexion -->
        <div class="text-center mt-3">
            <a
                href="{{ route('login') }}"
                class="text-decoration-none">
                Retour à la connexion
            </a>
        </div>

    </form>

</x-guest-layout>