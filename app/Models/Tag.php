<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $guarded =[];

    public function getRouteKeyName()
    {
        return 'title';
    }
    
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
    
    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}
