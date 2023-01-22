<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
                'unique:' . User::class . ',email',
            ],
            'name' => [
                'required',
                'string',
            ],
            'image' => [
                'nullable',
                'image',
            ],
            'password' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'numeric',
                'unique:' . User::class . ',phone',
            ],
            'address' => [
                'nullable',
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
            'password.required' => "Mật khẩu không được để trống",
            'phone.required' => "Số điện thoại không được để trống",
            'phone.numeric' => "Số điện thoại phải là số",
            'phone.unique' => "Số điện thoại đã tồn tại",
        ];
    }
}
