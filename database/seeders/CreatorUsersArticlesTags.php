<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreatorUsersArticlesTags extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->count(2)->has(
                                                    \App\Models\Article::factory()->count(10)->hasAttached(
                                                                                                            \App\Models\Tag::factory()->count(3)->create(),
                                                                                                        )
                                                                                                
                                                )->create();
    }
}
