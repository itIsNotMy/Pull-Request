<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\TagsCollection;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected function prepareForValidation()
    {
        $tagsRequest = collect(explode(',', $this->tags))->keyBy(function($key){return $key;});

        $this->merge(['tags' => $tagsRequest]);
        
        $this->merge(['owner_id' => auth()->id()]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'required',
            "description" => 'required',
            "text" => 'required',
        ];
    }
}
