<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddKomponenRequest extends FormRequest
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
            'nama_komponen'=>['required'],
            'besaran'=>['required'],
            'tipe_komponen'=>['required'],
            'deskripsi_komponen'=>['nullable'],
        ];
    }
    
    public function messages()
    {
        return [
            'nama_komponen.required'=>'Nama Komponen harus diisi',
            'besaran.required'=>'Besaran harus diisi',
            'tipe_komponen.required'=>'Tipe Komponen harus diisi',
        ];
    }
}
