<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cookie;

class DeleteUnverifiedAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete-unverified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unverified user accounts older than a certain period';

    /**
     * Execute the console command.
     *
     * @return void
     * @method Builder whereNull(string $column)
     */


    public function handle(): void
    {
        $thresholdDate = Carbon::now()->subDays(config('auth.delete_unverified_after_days'));

        $unverifiedUsers = User::whereNull('email_verified_at')
            ->where('created_at', '<', $thresholdDate)
            ->get();

        foreach ($unverifiedUsers as $user) {
            $user->forceDelete();
        }

        $this->info('Unverified user accounts deleted successfully.');
    }
}
