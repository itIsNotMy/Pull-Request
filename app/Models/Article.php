<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;
use App\Services\CreatorInterface;
use App\Casts\Json;

class Article extends Model implements TaggingModel, CreatorInterface
{
    use HasFactory;

    public $guarded =[];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article)
        {
            $changedFields = $article->getDirty();

            $article->history()->create(['article_id' => $article->id, 'user_id' => \Auth::User()->id, 'changed_fields' => $changedFields]);
        });

        static::created(function () {
            \Cache::tags(['article', 'article_tag'])->flush();
        });

        static::updated(function (Article $article) {
            \Cache::tags(['article', 'article_tag'])->flush();
            \Cache::tags(['comment', 'article'])->forget('comment=' . $article->id);
        });

        static::deleted(function () {
            \Cache::tags(['article', 'article_tag'])->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function history()
    {
        return $this->hasMany(ArticlesHistory::class);
    }
}
