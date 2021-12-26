<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Validation\ValidationException;

class CreatorCommentArticleAndNews implements CreatorCommentArticleAndNewsInterface
{
    public function comment (\App\Services\CreatorInterface $model, \Illuminate\Http\Request $request){
        if (\Auth::check()) {
           $model->comment()->create(['text' => $request->text, 'user_id' => \Auth::User()->id]);
        } else {
            throw ValidationException::withMessages(['field_name' => 'Please enter your account']);
        }
    }
}
