<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaryawanRequest extends FormRequest
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
            'k_nama'=>['required'],
            'k_contact'=>['required'],
            'k_email'=>['required'],
            'K_alamat'=>['required'],
            'k_nik'=>['required'],
            'k_divisi'=>['required'],
        ];
    }
}
