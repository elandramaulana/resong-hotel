<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLaundryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'laundry_type'=>['required'],
            'checkin_id'=>['nullable'],
            'send_cat_desc'=>['nullable'],
            'send_cat_id'=>['required'],
            'send_cat_price'=>['required'],
            'send_cat_qty'=>['required']
        ];
    }
}
