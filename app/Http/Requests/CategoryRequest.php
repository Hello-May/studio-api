<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|unique:categories,name',
            'index' => 'required|integer|unique:categories,index'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH']))
            $rules['name'] = 'required|string|unique:categories,name,' . $this->route()->parameter('category')->name;

        return $rules;
    }
}
