<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MyFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (request()->method() == 'POST') {
            $code = 'alpha_dash|unique:articles';
        } else {
            $code = ['alpha_dash', Rule::unique('articles')->ignore(request()->code, 'code')];
        }

        return [
            'code' => $code,
            'title' => 'required|between:5,100',
            'description' => 'required|max:255',
            'text' => 'required',
        ];
    }
}
