<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLatePointRequest extends FormRequest
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
            'first_late'        => ['required'],
            'first_latepoint'   => ['required'],
            'second_late'       => ['required_with:third_late,third_latepoint,second_latepoint'],
            'second_latepoint'  => ['required_with:third_late,third_latepoint,second_late'],
            'third_late'        => ['required_with:third_latepoint'],
            'third_latepoint'   => ['required_with:third_late'],
            'besar_point'       => ['required'],
            'besar_potongan'    => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_late.required' => 'Nilai Keterlambatan pertama harus diisi',
            'first_latepoint.required' => 'Poin pertama harus diisi',
            'second_late.required_with' => 'Nilai Keterlambatan kedua harus diisi jika ada poin kedua',
            'second_latepoint.required_with' => 'Poin kedua harus diisi jika ada Nilai Keterlambatan kedua',
            'third_late.required_with' => 'Nilai Keterlambatan ketiga harus diisi jika ada poin ketiga',
            'third_latepoint.required_with' => 'Poin ketiga harus diisi jika ada Nilai Keterlambatan ketiga',
            'besar_point.required' => 'Poin besar harus diisi',
            'besar_potongan.required' => 'Potongan besar harus diisi',
        ];
    }
}
