<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
        $id = $this->request->get('id');
        return [
            'name' => 'required|unique:packages,name,'.$id,
            'price' => 'required',
            'from_date' => 'required',
            'from_to' => 'required',
            'test' => 'required',
            'package_for' =>'required',
            'package_meant_for' => 'required',
        ];
    }
}
