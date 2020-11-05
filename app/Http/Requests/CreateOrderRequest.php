<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'product_id' => 'required|integer',
            'phone'      =>  'required|numeric|min:10',
            'user_name' => 'max:245',
            'user_email' => 'email',
            'user_comment' => 'max:1200'
        ];
    }
}
