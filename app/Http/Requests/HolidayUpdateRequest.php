<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \App\BlackDate;
class HolidayUpdateRequest extends FormRequest
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
        //$id= $this->id;
        //$result =BlackDate::select('id')->where('id',$id)->first();
        return [
            'name' =>'required',
            'status' => 'required',
            'date' => 'required',
        ];
    }
}
