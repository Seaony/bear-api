<?php

namespace App\Http\Requests\Api\Eggs;

use Illuminate\Foundation\Http\FormRequest;

class CrackedRequest extends FormRequest
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
            'cracked_at' => 'required|date',
            'cat_number' => 'nullable|numeric|max:100',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'cracked_at' => '出生日期',
            'cat_number' => '小猫数量',
        ];
    }
}
