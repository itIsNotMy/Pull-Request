<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;

class News extends Model implements TaggingModel
{   
    use HasFactory;
    
    public $guarded =[];
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
