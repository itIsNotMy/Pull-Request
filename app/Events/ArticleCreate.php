<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleCreate
{
    use Dispatchable;
    
    public $article;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}
