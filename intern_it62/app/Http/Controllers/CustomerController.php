<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Http\Requests\ImportFileRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Imports\CustomerImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::allCustomer()->paginate(10);
        return view('customers', compact('customers'));
    }

    public function search(Request $request)
    {
        $customers = Customer::name($request->customer_name)
                    ->email($request->email)
                    ->address($request->address)
                    ->active($request->is_active)
                    ->orderBy('id', 'desc')->paginate(2);
        $total_customers = $customers->total();
        // Tạo HTML phân trang từ view 'users.blade.php'
        $pagination = $customers->appends($request->except('page'))->links()->toHtml();
        return response()->json([
            'success' => true,
            'customers' => $customers->items(),
            'total_customers' => $total_customers,
            'pagination' => $pagination
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        // Lưu dữ liệu
        $obj = new Customer();
        $obj->customer_name = $request->customer_name;
        $obj->email = $request->email;
        $obj->tel_num = $request->tel_num;
        $obj->address = $request->address;
        if ($request->is_active == 1) {
            $obj->is_active = 1;
        } else {
            $obj->is_active = 0;
        }
        $obj->save();

        return redirect()->back()->with('success', 'Thêm thành công');
    }

    public function lock($id)
    {
        $customer = Customer::find($id);

        // Thay dữ liệu cột is_active
        if ($customer->is_active == 1) {
            $customer->is_active = 0;
            $customer->save();

            return redirect()->back()->with('success', 'Khóa thành công');
        } else {
            $customer->is_active = 1;
            $customer->save();
            return redirect()->back()->with('success', 'Mở khóa thành công');
        }
        return redirect()->back()->with('error', 'Thao tác thất bại');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function update(UpdateCustomerRequest $request)
    {
        $customer = Customer::find($request->id);
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->tel_num = $request->tel_num;
        $customer->address = $request->address;
        $customer->update();

        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function import(ImportFileRequest $request)
    {
        Excel::import(new CustomerImport(), $request->file('file'));

        return redirect()->back()->with('success', 'Import thành công');
    }

    public function export(Request $request)
    {
        $searchs = [];
        if (!empty($request->customer_name)) {
            $searchs['customer_name'] = $request->customer_name;
        }

        if (!empty($request->email)) {
            $searchs['email'] = $request->email;
        }

        if (!empty($request->is_active)) {
            $searchs['is_active'] = $request->is_active;
        }

        if (!empty($request->address)) {
            $searchs['address'] = $request->address;
        }

        return Excel::download(new CustomerExport($searchs), 'customers_export.xlsx');
    }
}
