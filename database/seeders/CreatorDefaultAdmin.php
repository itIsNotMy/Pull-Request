<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreatorDefaultAdmin extends Seeder
{
    public function run()
    {
        \App\Models\User::create(['name' => 'Admin', 'email' => \Config::get('mailAdmin.mailAdmin'), 'password' => bcrypt(123), 'role_id' =>1]);
    }
}
