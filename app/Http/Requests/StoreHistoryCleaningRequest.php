<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoryCleaningRequest extends FormRequest
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
            'tanggal_cleaning'=>['required'],
            'jam_cleaning'=>['required'],
            'pic_cleaning'=>['required'],
            'room_type'=>['required'],
            'room_no'=>['required'],
            'status'=>['required']
        ];
    }
}
