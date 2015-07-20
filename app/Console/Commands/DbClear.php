<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class DbClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the dB';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Clearing database');
        $f = storage_path('database.sqlite');
        if(File::exists($f)){
            File::delete($f);
        }
        File::put($f,'');
        $this->info('Database cleared');
    }
}
