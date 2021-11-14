<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
                        CreatorRoles::class,
                        CreatorDefaultAdmin::class,
                        CreatorUsersArticlesTags::class,
                    ]);
    }
}
