<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'image' => [
                'required',
                'image',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'amount' => [
                'required',
                'integer',
            ],
            'created_by_id' => [
                'nullable',
                'integer',
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên sản phẩm không được để trống",
            'image.required' => "Ảnh không được để trống",
            'image.image' => "File phải là ảnh",
            'price.required' => "Giá tiền không được để trống",
            'price.numeric' => "Giá tiền phải là số",
            'amount.required' => "Số lượng không được để trống",
            'amount.integer' => "Số lượng phải là số",
        ];
    }
}
