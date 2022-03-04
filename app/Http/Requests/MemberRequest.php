<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'uid' => 'required|string|unique:members,uid',
            'display_name' => 'required|string',
            'picture_url' => 'required|string|url',
            'status_message' => 'nullable|string',
            'role' => 'required|string', // 可以規定 enum 嗎
            'gender' => 'required|string', // 可以規定 enum 嗎
            'birth'  => 'nullable|date',
            'phone' => 'nullable|string|regex:/^09\d{8}$/',
            'email' => 'nullable|string|email',
            'about_me' => 'nullable|string',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $member = $this->route()->parameter('member');

            $rules['uid'] = [
                'required',
                'string',
                'exists:members,uid',
                Rule::unique('members')->ignore($member,'uid'),
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            '*.required' => "required",
            '*.string' => 'string',
            '*.unique' => 'unique',
            '*.exists' => 'exists',
            '*.uuid' => 'uuid',
            '*.url' => 'url',
            '*.date' => 'date',
            '*.email' => 'email',
            'phone.regex' => 'regex: /^09\d{8}$/',
        ];
    }
}
