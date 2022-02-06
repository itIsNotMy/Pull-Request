<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class CreateNewCommentForArticle
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $article;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}
