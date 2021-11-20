<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleCreate
{
    use Dispatchable;
    
    public $article;
    public $pushAll;
    
    public function __construct(Article $article, \App\Services\Pushall $pushAll)
    {
        $this->article = $article;
        $this->pushAll = $pushAll;
    }
}
