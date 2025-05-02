<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'room_id'=>['required'],
            'reservation_payment_status'=>['required'],
            'reservation_payment_method'=>['required'],
            'reservation_time_checkin' => ['nullable', 'date_format:H:i'],
            'reservation_time_checkout' => ['nullable', 'date_format:H:i'],
            'reservation_payment'=>[
                'required',
                function ($attribute, $value, $fail) {
                    if ($this->reservation_payment_status === 'DP') {
                        $halfPayment = (int)str_replace(['Rp. ', '.'], ['', ''], $this->total_bayar) / 2;
                        if ($value < $halfPayment) {
                            $fail('The ' . $attribute . ' must be at least ' . number_format($halfPayment, 0, ',', '.') . '.');
                        }
                    }
                }
            ]
        ];
    }
}
