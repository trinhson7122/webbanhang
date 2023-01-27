<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'address' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'numeric',
            ],
            'note' => [
                'nullable',
                'string',
            ],
        ];
    }
    public function messages()
    {
        return [
            'address.required' => "Địa chỉ không được để trống",
            'phone.required' => "Số điện thoại không được để trống",
            'phone.numeric' => "Số điện thoại phải là số",
        ];
    }
}
