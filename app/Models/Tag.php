<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $guarded =[];
    
    public function getRouteKeyName()
    {
        return 'title';
    }
    
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
