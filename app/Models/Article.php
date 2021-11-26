<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;

class Article extends Model implements TaggingModel
{
    use HasFactory;
    
    public $guarded =[];
    
    protected static function boot()
    {
        parent::boot();
        
        static::updating(function (Article $article){
            
                                                        $changedFields = $article->getDirty();
            
                                                        $article->history()->create(['article_id' => $article->id, 'user_id' => \Auth::User()->id, 'changed_fields' => json_encode($changedFields) ]);
 
                                                    });
    }
    
    public function getRouteKeyName()
    {
        return 'code';
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }
    
    public function history()
    {
        return $this->hasMany(ArticlesHistory::class);
    }
}
