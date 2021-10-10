<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'information' => 'required|string|max:255',
            'is_selling' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
            'files.*.image' => 'required|image|mimes:png,jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image' => 'Not iamge',
            'mine' => 'Not png, jpeg, jpg',
            'max' => 'Too large',
        ];
    }
}
