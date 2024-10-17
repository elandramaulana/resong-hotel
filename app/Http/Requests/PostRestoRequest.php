<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRestoRequest extends FormRequest
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
            'customer_type'=>['required'],
            'guest_name'=>['nullable'],
            'guest_contact'=>['nullable'],
            'guest_email'=>['nullable'],
            'checkin_id'=>['nullable'],
        ];
    }
}
