<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\TaggingModel;

class Article extends Model implements TaggingModel
{
    public $guarded =[];
    
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
}
