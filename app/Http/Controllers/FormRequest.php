<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class FormRequest
{
    public static function requestHandler($request, $articles = null)
    {
        if ($request->method() == 'POST') {
            $valArray = $request->validate([
                        'code' => 'alpha_dash|unique:articles',
                        'title' => 'required|between:5,100',
                        'description' => 'required|max:255',
                        'text' => 'required',
                        ]);
        } else {
            $valArray = $request->validate([
                        'code' => ['alpha_dash', Rule::unique('articles')->ignore($articles)],
                        'title' => 'required|between:5,100',
                        'description' => 'required|max:255',
                        'text' => 'required',
                        ]);
        }
        
        if (request()->input('checkbox') !== null) {
            $valArray += ['datePublished' => Carbon::now()];
            
        }
        
        return $valArray;
    }
}