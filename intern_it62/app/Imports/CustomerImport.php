<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomerImport implements ToCollection, WithValidation, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $i = 1;
        foreach ($rows as $row) {
            $validator = Validator::make($row->toArray(), [
                'customer_name' => 'required|max:255', // customer_name validation rules
                'email' => 'required|email|unique:customers', // email validation rules
                'tel_num' => 'required|regex:/^0[0-9]{9}$/', // tel_num validation rules
                'address' => 'required', // address validation rules
            ], [
                'customer_name.required' => "Dòng {$i} Tên không được bỏ trống",
                'customer_name.min' => "Dòng {$i} Tên phải lớn hơn 5 ký tự",
                'email.required' => "Dòng {$i} Email không được bỏ trống",
                'email.email' => "Dòng {$i} Email không hợp lệ",
                'email.unique' => "Dòng {$i} Email đã được đăng ký",
                'tel_num.required' => "Dòng {$i} Số điện thoại không được bỏ trống",
                'tel_num.regex' => "Dòng {$i} Số điện thoại không hợp lệ",
                'address.required' => "Dòng {$i} Địa chỉ không được bỏ trống"
            ]);

            // Thông báo lỗi với người dùng
            if ($validator->fails()) {
                Session::flash('errors', $validator->errors());
                $i++;
                continue; // Bỏ qua dòng này và tiếp tục với dòng kế tiếp
            }

            $i++;
            Customer::create([
                'customer_name' => $row['customer_name'],
                'email' => $row['email'],
                'tel_num' => $row['tel_num'],
                'address' => $row['address'],
                'is_active' => 1
            ]);
        }
    }

    public function rules(): array
    {
        return [
            // You can still define rules here for the entire import
        ];
    }
}
