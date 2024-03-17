<?php

namespace App\Http\Requests;

use App\Models\Rooms;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            //detail checkin
            'room_id'=>['required'],
            'invoice'=>['required'],
            'checkin_time'=>['required'],
            'checkout_time'=>['required', 'after_or_equal:'.$this->input('checkin_time')],
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
            'religion'=>['required'], 
            'title'=>['required'], 
            'country'=>['required'], 
            'province'=>['required'], 
            'city'=>['required'], 
            'postal_code'=>['required'], 
            'email_address'=>['nullable'], 
            'telp_number'=>['required'], 
            'document'=>['nullable'],
            'deposit'=>['required'], 
            'payment_method'=>['required'], 
        ];
    }
}
