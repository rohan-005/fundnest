<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Console\Command;

class DeactivateExpiredScholarships extends Command
{
    protected $signature   = 'scholarships:deactivate-expired';
    protected $description = 'Deactivate scholarships past their deadline and notify admins';

    public function handle(): void
    {
        $expired = Scholarship::where('is_active', true)
            ->where('deadline', '<', now())
            ->get();

        if ($expired->isEmpty()) {
            $this->info('No expired scholarships found.');
            return;
        }

        foreach ($expired as $scholarship) {

            $scholarship->update(['is_active' => false]);

            $this->line("Deactivated: {$scholarship->title}");

            /*
            |--------------------------------------------------------------------------
            | NOTIFY ALL ADMINS
            |--------------------------------------------------------------------------
            */

            $admins = User::whereIn('role', ['admin', 'super_admin'])->get();

            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title'   => 'Scholarship Expired & Deactivated',
                    'message' => "The scholarship \"{$scholarship->title}\" has passed its deadline and has been automatically deactivated.",
                ]);
            }
        }

        $this->info("Deactivated {$expired->count()} scholarship(s).");
    }
}
