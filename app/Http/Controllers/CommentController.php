<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        if (\Auth::check()) {
            Comment::create(['article_id' => $request->article, 'user_id' => \Auth::User()->id, 'text' => $request->text]);
            return redirect()->back();
        } else {
            throw ValidationException::withMessages(['field_name' => 'Please enter your account']);
        }
    }
}
