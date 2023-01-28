<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'name' => [
                'required',
                'string',
            ],
            'image' => [
                'nullable',
                'image',
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'address' => [
                'required',
                'string',
            ],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => "Email không được để trống",
            'email.email' => "Email không đúng định dạng",
            'email.unique' => "Email đã tồn tại",
            'name.required' => "Tên không được để trống",
            'address.required' => "Địa chỉ không được để trống",
            'phone.required' => "Số điện thoại không được để trống",
            'phone.numeric' => "Số điện thoại phải là số",
            'phone.unique' => "Số điện thoại đã tồn tại",
            'image.image' => "File phải là hình ảnh",
        ];
    }
}
