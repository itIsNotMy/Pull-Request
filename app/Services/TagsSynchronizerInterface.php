<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;

interface TagsSynchronizerInterface
{
    public function sync(\Illuminate\Support\Collection $tags, Article $article);
}
