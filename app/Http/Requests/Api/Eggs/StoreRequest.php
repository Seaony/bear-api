<?php

namespace App\Http\Requests\Api\Eggs;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'male_name'   => 'required|string',
            'female_name' => 'required|string',
            'breeding_at' => 'required|date',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'male_name'   => '公猫名称',
            'female_name' => '母猫名称',
            'breeding_at' => '配种日期',
        ];
    }
}
