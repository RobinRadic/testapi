<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class DbRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:clear');
        $this->call('migrate');
        $this->call('db:seed');
        $this->info('Database cleared, migrated and seeded');
    }
}
