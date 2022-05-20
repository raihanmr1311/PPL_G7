<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo 'Rp' . number_format($amount, 2, ',', '.'); ?>";
        });

        Blade::if('owner', function () {
            return auth()->user()->isOwner();
        });

        Blade::if('employe', function () {
            return auth()->user()->isEmploye();
        });
    }
}
