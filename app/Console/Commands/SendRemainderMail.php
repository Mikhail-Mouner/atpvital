<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RemainderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendRemainderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'schedule a daily email at 08:00 PM that will be sent to advertisers who have ads the next day as a remainder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereHas('ads')->get();

        $users->map(function ($user) {
            $user->notify(new RemainderNotification());
        });
        $this->info('Finish Send');
    }
}
