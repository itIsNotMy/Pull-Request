<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ArticleMailCreate;

class JobReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $request;

    public function __construct($request)
    {
        $this->request = $request->request;
    }

    public function handle()
    {
        foreach ($this->request as $key=>$val) {
            if($val == 'on' && class_exists('\App\Models\\'.$key)) {
                $reoprt[$key] = ('\App\Models\\'.$key)::count();
            }
        }
        
        \Mail::to(\Config::get('mailAdmin.mailAdmin', 'qwe@gmail.com'))->send(
            new \App\Mail\ReportMail($reoprt)
        );
    }
}
