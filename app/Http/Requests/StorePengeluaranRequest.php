<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengeluaranRequest extends FormRequest
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
            'item'=>'required',
            'jumlah'=>'required|integer',
            'harga'=>'required|numeric',
            'tanggal'=>'required|date',
            'keterangan'=>'nullable',
        ];
    }


    public function messages(): array
    {
        return [
            'item.required' => 'Item harus diisi',
            'jumlah.required' => 'Qty harus diisi',
            'jumlah.integer' => 'Qty harus berupa angka',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'tgl.required' => 'Tanggal harus diisi',
            'tgl.date' => 'Tanggal harus berupa tanggal',
        ];
    }
}
