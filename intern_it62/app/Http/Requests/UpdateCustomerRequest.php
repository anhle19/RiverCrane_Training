<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'customer_name' => 'required|min:6',
            'email' => ['required', 'email', Rule::unique('customers')->ignore($id)],
            'tel_num' => 'required|regex:/^0[0-9]{9}$/',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Tên không được bỏ trống',
            'customer_name.min' => 'Tên phải lớn hơn 5 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được đăng ký',
            'tel_num.required' => 'Số điện thoại không được bỏ trống',
            'tel_num.regex' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Địa chỉ không được bỏ trống'
        ];
    }
}
