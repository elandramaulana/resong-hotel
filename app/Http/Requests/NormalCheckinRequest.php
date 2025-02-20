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
        return [
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
            'id_number'=>['required'],
            'place_of_birth'=>['required'],
            'date_of_birth'=>['required'],
            'gender'=>['required'],
            'agama'=>['required'],
            'title'=>['required'],
            'country'=>['required'],
            'province'=>['required'],
            'city'=>['required'],
            'postal_code'=>['required'],
            'frm_email'=>['required', 'email'],
            'telp_number'=>['required'],
            'document'=>['nullable'],
            'deposit'=>['required'],
            'total_bayar'=>['required'],
            'payment_method'=>['required'],
        ];
    }
}
