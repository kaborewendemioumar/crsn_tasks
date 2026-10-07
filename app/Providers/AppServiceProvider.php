<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            // 1. Forcer le HTTPS sur Render
            URL::forceScheme('https');

            // 2. Lancer les migrations de manière autonome au chargement
            try {
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Exception $e) {
                // Enregistre l'erreur dans les logs Laravel sans bloquer l'affichage
                logger('Erreur lors de la migration automatique Render : ' . $e->getMessage());
            }
        }
    }
}
