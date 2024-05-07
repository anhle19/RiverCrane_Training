<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Customer extends Model
{
    use HasFactory;
    use Sortable;

    //Chỉ định table và primary key
    protected $table = 'customers';
    protected $fillable = [
        'customer_name',
        'email',
        'tel_num',
        'address',
        'is_active'
    ];
    public $sortable = ['customer_name', 'email', 'tel_num', 'address'];

    public function scopeAllCustomer()
    {
        return Customer::sortable();
    }

    public function scopeName($query, $customerName)
    {
        if (!is_null($customerName)) {
            return $query->where('customer_name', 'LIKE', '%' . $customerName . '%');
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('customer_name', $email);
        }
        return $query;
    }

    public function scopeAddress($query, $address)
    {
        if (!is_null($address)) {
            return $query->where('address', 'LIKE', '%' . $address . '%');
        }
        return $query;
    }

    public function scopeActive($query, $isActive)
    {
        if (!is_null($isActive)) {
            return $query->where('is_active', $isActive);
        }
        return $query;
    }
}
