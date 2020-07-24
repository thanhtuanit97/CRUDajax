<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name'=> 'required|min:10|max:40',
            'email'=>'required',
            'address'=>'required',
            'phone'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Tên học sinh không được để trống',
            'name.min'=> ':attribute quá ngắn',
            'name.max'=>':attribute quá dài',
            

            'email.required'=> ':attribute không được để trống',
            'address.required'=> ':attribute không được để trống',
            'phone.required'=> ':attribute không được để trống',
        ];
    }

     public function attributes()
    {
         return [
            'name'=> 'Tên học sinh',
            'email'=>'Email',
            'address'=>'Địa chỉ',
            'phone'=>'Số điện thoại'
        ];
    }
}
