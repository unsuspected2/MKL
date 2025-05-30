<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class GlobalVariablesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
            if (Schema::hasTable('supplier')) {
                $fornecedores = \App\Models\Supplier::all();
                View::share('fornecedores', $fornecedores);
            }
        
    }
}
