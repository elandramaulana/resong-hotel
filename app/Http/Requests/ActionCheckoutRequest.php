<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionCheckoutRequest extends FormRequest
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
            'checkin_id' => ['required'],
            'refund_deposit' => ['nullable'],
            'checkout_hour' => ['required'],
            'checkout_descriptions' => ['required_unless:refund_deposit,1', 'nullable', 'string', 'max:225']
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'checkin_id.required' => 'The check-in ID is required.',
            'checkout_hour.required' => 'The checkout time is required.',
            // 'refund_deposit.required' => 'Please specify if a refund deposit is required.',
            'checkout_descriptions.required_if' => 'Checkout descriptions are required when no refund deposit is specified.',
            'checkout_descriptions.numeric' => 'The checkout description must be a number.',
            'checkout_descriptions.max' => 'The checkout description may not be greater than 225 characters.',
        ];
    }

}
