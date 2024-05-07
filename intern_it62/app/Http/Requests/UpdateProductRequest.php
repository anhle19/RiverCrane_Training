<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_name' => 'required|min:6',
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'mimes:png,jpg,jpeg|max:2000'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được bỏ trống',
            'product_name.min' => 'Tên sản phẩm phải lớn hơn 5 ký tự',
            'product_price.required' => 'Giá bán không được bỏ trống',
            'product_price.numeric' => 'Giá bán phải là số',
            'product_price.min' => 'Giá bán phải lớn hơn 0',
            'product_image.mimes' => 'Hình ảnh phải là png,jpg,jpeg',
            'product_image.max' => 'Hình ảnh phải nhỏ hơn 2MB'
        ];
    }
}
