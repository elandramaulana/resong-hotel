<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSpeedyCheckin extends FormRequest
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
            'reservation_name'=>['required'],
            'speedy_checkin_time'=>['required'],
            'reservation_contact'=>['required'],
            'speedy_checkout_time'=>['required'],
        ];
    }
}
