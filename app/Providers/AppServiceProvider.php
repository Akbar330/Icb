<?php

// App\Providers\AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Berita;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Menyebarkan berita ke semua view yang menggunakan layout utama
        View::composer('layouts.main', function ($view) {
            $beritas = Berita::latest()->take(5)->get(); // Ambil 5 berita terbaru
            $view->with('beritas', $beritas); // Share data berita ke view
        });
    }

    public function register()
    {
        //
    }
}

