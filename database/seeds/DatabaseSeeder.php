<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Laradic\Support\String;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        Model::unguard();
        $this->call('UserSeeder');
        Model::reguard();
    }
}
