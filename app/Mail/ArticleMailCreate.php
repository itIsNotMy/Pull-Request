<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleMailCreate extends Mailable
{
    use Queueable, SerializesModels;
    
    public $article;

    public function __construct($article)
    {
        $this->article = $article;
    }
    public function build()
    {
        return $this->markdown('mail.articleCreate');
    }
}
