<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCommentRequest extends FormRequest
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
            'name' => 'max:50',
            'email' => 'required|email|max:200',
            'comment' => 'required|max:1250',
            'product_id' => 'required|max:20',
            'rating' => 'max:1',
        ];
    }
}
