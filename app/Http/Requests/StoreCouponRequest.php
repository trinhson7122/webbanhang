<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'discount' => [
                'required',
                'numeric',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'max' => [
                'required',
                'numeric',
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên mã giảm giá không được để trống', 
            'discount.required' => '% giảm giá không được để trống', 
            'discount.numeric' => '% giảm giá phải là số', 
            'amount.required' => 'Số lượng mã giảm giá không được để trống', 
            'amount.numeric' => 'Số lượng mã giảm giá phải là số', 
            'max.required' => 'Số tiền giảm tối đa không được để trống', 
            'max.numeric' => 'Số tiền giảm tối đa phải là số', 
        ];
    }
}
