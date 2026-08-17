<x-guest-layout>

    <!-- En-tête -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary mb-1">
            TACHES DE CRSN
        </h2>

        <p class="text-muted mb-0">
            Création de votre compte
        </p>
    </div>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <label
                for="name"
                class="form-label fw-semibold">
                Nom complet
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                class="form-control"
                placeholder="Entrez votre nom complet"
            >

            @error('name')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Adresse e-mail -->
        <div class="mb-3">
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
                autocomplete="username"
                class="form-control"
                placeholder="Entrez votre adresse e-mail"
            >

            @error('email')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-3">
            <label
                for="password"
                class="form-label fw-semibold">
                Mot de passe
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="form-control"
                placeholder="Créez votre mot de passe"
            >

            @error('password')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-4">
            <label
                for="password_confirmation"
                class="form-label fw-semibold">
                Confirmer le mot de passe
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="form-control"
                placeholder="Confirmez votre mot de passe"
            >

            @error('password_confirmation')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="d-grid mb-3">
            <button
                type="submit"
                class="btn btn-primary btn-lg">
                S'inscrire
            </button>
        </div>

        <!-- Retour connexion -->
        <div class="text-center">
            <span class="text-muted">
                Vous avez déjà un compte ?
            </span>

            <a
                href="{{ route('login') }}"
                class="text-primary text-decoration-none fw-semibold">
                Se connecter
            </a>
        </div>

    </form>

</x-guest-layout>