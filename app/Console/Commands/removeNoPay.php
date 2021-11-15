<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ProfileController;

class removeNoPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestion automatique des profils.';

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
    public function handle(ProfileController $profile)
    {
        $profile->removeNoPay();
        $profile->manqueProfiles();
        $profile->avertissements();
        return Command::SUCCESS;
    }
}
