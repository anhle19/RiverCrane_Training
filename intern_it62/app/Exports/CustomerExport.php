<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    // Lấy dữ liệu tìm kiếm từ danh sách được lọc
    private $searchs;
    public function __construct($searchs)
    {
        $this->searchs = $searchs;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $customersQuery = Customer::query();
        if (!isset($this->searchs)) {
            $customers = $customersQuery->paginate(10);
        } else {
            if (isset($this->searchs['customer_name'])) {
                $customersQuery->where('customer_name', 'LIKE', '%' . $this->searchs['customer_name'] . '%');
            }
            if (isset($this->searchs['email'])) {
                $customersQuery->where('email', $this->searchs['email']);
            }
            if (isset($this->searchs['is_active'])) {
                $customersQuery->where('is_active', $this->searchs['is_active']);
            }
            if (isset($this->searchs['address'])) {
                $customersQuery->where('address', 'LIKE', '%' . $this->searchs['address'] . '%');
            }
            $customers = $customersQuery->get();
        }
        return view('customers_export', compact('customers'));
    }
}
