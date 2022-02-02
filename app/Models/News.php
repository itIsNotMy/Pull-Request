<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;
use App\Services\CreatorInterface;

class News extends Model implements TaggingModel, CreatorInterface
{   
    use HasFactory;
    
    public $guarded =[];
    
    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags(['news', 'news_tag'])->flush();
        });

        static::updated(function (News $news) {
            \Cache::tags(['news', 'news_tag'])->flush();
            \Cache::tags(['comment', 'news'])->forget('comment=' . $news->id);
        });

        static::deleted(function () {
            \Cache::tags(['news', 'news_tag'])->flush();
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
