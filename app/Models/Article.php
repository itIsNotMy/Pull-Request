<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;
use App\Casts\Json;

class Article extends Model implements TaggingModel
{
    use HasFactory;

    public $guarded =[];
    
    protected $appends = [
        'length_article'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article)
        {
            $changedFields = $article->getDirty();

            $article->history()->create(['article_id' => $article->id, 'user_id' => \Auth::User()->id, 'changed_fields' => $changedFields]);
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
    
    public function getlengthArticleAttribute()
    {   
        return strlen($this->text);
    }
    
    public function maxArticleText()
    {   
        return self::all()->sortByDesc('length_article')->first();
    }
    
    public function minArticleText()
    {   
        return self::all()->sortBy('length_article')->first();
    }
}
