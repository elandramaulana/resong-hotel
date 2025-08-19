<?php

namespace App\Http\Requests;

use App\Models\Rooms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class NormalCheckinRequest extends FormRequest
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
        $Room_Info = Rooms::find($this->input('room_id'));
        if($this->input('title') == "Ms" || $this->input('title') == "Mrs"){
            $this->merge(['gender' => 'Perempuan']);
        }else{
            $this->merge(['gender' => 'Laki-laki']);
        }
        //convert date format

        if ($this->input('checkin_time') !== null) {
            $this->merge(['checkin_time' => date('Y-m-d', strtotime($this->input('checkin_time')))]);
        }
        if ($this->input('checkout_time') !== null) {
            $this->merge(['checkout_time' => date('Y-m-d', strtotime($this->input('checkout_time')))]);
        }
        //convert time format
        if ($this->input('checkinHour') !== null) {
            $this->merge(['checkinHour' => date('H:i:s', strtotime($this->input('checkinHour')))]);
        }
        Log::info($this->input('checkin_time'));


        $rule = [
            //detail checkin
            'room_id'=>['required'],
            'invoice'=>['required'],
            'checkin_time' => ['required', 'date', 'after_or_equal:today'],
            'checkinHour' => ['required'],
            'checkout_time'=>['required', 'date', 'after:checkin_time'],
            'number_of_adult'=>['required','numeric', 'max:'.$Room_Info->room_capacity],
            'number_of_children'=>['nullable'],
            'channel'=>['required'],
            //detail guest
            'name_guest'=>['required'],
            'id_type'=>['required'],
            'id_number'=>['required'],
            'id_number'=>['nullable'],
            'place_of_birth'=>['nullable'],
            'date_of_birth'=>['nullable'],
            'gender'=>['nullable'],
            'agama'=>['nullable'],
            'title'=>['nullable'],
            'country'=>['nullable'],
            'province'=>['nullable'],
            'city'=>['nullable'],
            'postal_code'=>['nullable'],
            'frm_email'=>['nullable', 'email'],
            'telp_number'=>['required'],
            'document'=>['nullable'],
            'payment_method'=>['required'],
        ];
        $deposit_type = $this->input('jenis_deposit');
        if($deposit_type == 'Cash'){
            $rule['deposit'] = ['required'];
        }else{
            $rule['deposit_lain'] = ['required'];
        }

        return $rule;
    }
}
