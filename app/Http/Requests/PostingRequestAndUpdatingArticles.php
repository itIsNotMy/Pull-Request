<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Services\TagsCollection;

class PostingRequestAndUpdatingArticles extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    protected function prepareForValidation()
    {
        if ($this->datePublished !== null) {
            $this->merge(['datePublished' => Carbon::now()]);
        }

        $tagsRequest = collect(explode(',', $this->tags))->keyBy(function($key){return $key;});

        $this->merge(['tags' => $tagsRequest]);
    }

    public function rules()
    {
        if ($this->method() == 'POST') {
            $code = 'alpha_dash|unique:articles';
        } else {
            $code = ['alpha_dash', Rule::unique('articles')->ignore($this->code, 'code')];
        }

        return [
            'code' => $code,
            'title' => 'required|between:5,100',
            'description' => 'required|max:255',
            'text' => 'required',
            'datePublished' => '',
        ];
    }
}
