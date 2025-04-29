<?php

namespace App\Providers;

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        // Créer une directive Blade pour les images de livres
        Blade::directive('bookImage', function ($expression) {
            return "<?php echo \App\Helpers\ImageHelper::getBookImageUrl($expression); ?>";
        });
    }
}
