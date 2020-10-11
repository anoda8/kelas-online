<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes(['prefix' => 'guru', 'middleware' => ['role:guru']], ['prefix' => 'siswa', 'middleware' => ['role:siswa']]);

        require base_path('routes/channels.php');
    }
}
