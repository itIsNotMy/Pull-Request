<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NotifiArticlesUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifiUsers {frome? : 0000-00-00 00:00:00} {to? : 0000-00-00 00:00:00}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'отправка новых статей пользеваетлям  в ведите интервал из двух значений вида "0000-00-00 00:00:00" без значений команда вернет интервал за неделю';

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
        $articles = \App\Models\Article::when($this->argument('frome') == null || $this->argument('to') == null, function ($query) {
                                                return $query->where('datePublished', '>=', NOW()->sub(new \DateInterval("P0Y0M7DT0H0M0S")))->orWhere('datePublished', '=<', NOW());
                                            }, function ($query) {
                                                return $query->where('datePublished', '>=', $this->argument('frome'))->orWhere('datePublished', '=<', $this->argument('to'));
                                            })->get();
        
        $users = \App\Models\User::all();
        
        $users->map->notify(new \App\Notifications\UsersNotifiArticles($articles));
    }
}
