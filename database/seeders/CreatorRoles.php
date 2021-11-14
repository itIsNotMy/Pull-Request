<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreatorRoles extends Seeder
{
    public function run()
    {
        \App\Models\Role::create(['role' => 'administrator']);
        
        \App\Models\Role::create(['role' => 'user']);
    }
}
