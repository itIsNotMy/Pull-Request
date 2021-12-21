<?php

namespace App\Services;

interface CreatorCommentArticleAndNewsInterface
{
    public function comment(\App\Services\CreatorInterface $model, \Illuminate\Http\Request $request);
}
