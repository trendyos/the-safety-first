<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \App\PackageTest;
class TestUpdateRequest extends FormRequest
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
        $id= $this->id;
        $result =PackageTest::select('id')->where('id',$id)->first();
        return [
            'name' =>'required|unique:package_tests,name,'.$result->id.',id,deleted_at,NULL',
            'status' => 'required',
        ];
    }
}
