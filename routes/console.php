<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;


// Restarts the app only when DEMO_MODE is on

if (env('DEMO_MODE') === true) {
    Schedule::call(function () {
        Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);
    })->weeklyOn(1, '00:00');
}
