<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceCreateRequest extends FormRequest
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
            'uan' => 'required|alpha_num|max:12',
            'uan_min' => 'alpha_num|max:12'
        ];
    }
}
