<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRoomRequest extends FormRequest
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
            'reservation_name'=>['required', 'min:5'],
            'reservation_contact'=>['required'],
            'reservation_chanel'=>['required'],
            'reservation_email'=>['required', 'email'],
            'qty_guest'=>['nullable', 'numeric' ],
            'reservation_checkin'=>['required', 'date', 'after:'.date('Y-m-d')],
            'reservation_checkout'=>['required', 'date', 'after_or_equal:'.$this->input('reservation_checkin')],
            'reservation_desc'=>['nullable']
        ];
    }
}
