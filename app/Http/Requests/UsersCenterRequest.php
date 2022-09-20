<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UsersCenterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'state_id' => 'required',
            'country' => 'required',
            'email' =>'required|email|unique:users,email,'.Auth::user()->id,
        ];
    }
}
