<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtendRequest extends FormRequest
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
            'extend_checkin_id'=>['required'],
            'checkin_time_extend'=>['required','date', 'after_or_equal:'. $this->input('current_checkin')],
            'checkout_time_extend'=>['required', 'date', 'after:'. $this->input('current_checkout')]
        ];
    }
}
