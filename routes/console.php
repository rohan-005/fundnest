<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| SCHEDULED TASKS
|--------------------------------------------------------------------------
*/

// Deactivate expired scholarships every day at midnight
Schedule::command('scholarships:deactivate-expired')->daily();
