<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Continue_;

class ProductRequest extends FormRequest
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
        $base = [
            'name' => 'required|string|unique:products,name',
            'index' => 'required|integer|min:0|unique:products,index',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer',
            'description' => 'nullable|string'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH']) && str_contains($this->url(), 'product/list')) {
            $rules = [
                '*.id' => 'required|integer|min:0',
                '*.name' => 'required|string',
                '*.index' => 'required|integer|min:0',
                '*.category_id' => $base['category_id'],
                '*.price' => $base['price'],
                '*.description' => $base['description']
            ];

            foreach ($this->request as $key => $val) {
                if (!isset($val['id'])) continue;
                $rules[$key . '.name'] = $base['name'] . ',' . $val['id'];
                $rules[$key . '.index'] = $base['index'] . ',' . $val['id'];
            }
        } else {
            $rules = $base;
            $id = $this->route()->parameter('product')->id;

            if (in_array($this->method(), ['PUT', 'PATCH'])) {
                $rules['name'] = $base['name'] . ',' . $id;
                $rules['index'] = $base['index'] . ',' . $id;
            }
        }
        dump($rules);
        return $rules;
    }
}
