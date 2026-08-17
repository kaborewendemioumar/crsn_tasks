<x-guest-layout>

    <!-- En-tête -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary mb-1">
            TACHES DE CRSN
        </h2>

        <p class="text-muted mb-0">
            Connexion à votre compte
        </p>
    </div>

    <!-- Message de session -->
    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Formulaire de connexion -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                autofocus
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
                autocomplete="current-password"
                class="form-control"
                placeholder="Entrez votre mot de passe"
            >

            @error('password')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Se souvenir de moi -->
        <div class="mb-4 form-check">
            <input
                type="checkbox"
                class="form-check-input"
                id="remember_me"
                name="remember"
            >

            <label
                class="form-check-label"
                for="remember_me">
                Se souvenir de moi
            </label>
        </div>

        <!-- Bouton connexion -->
        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-primary btn-lg">
                Se connecter
            </button>
        </div>

    </form>

</x-guest-layout>