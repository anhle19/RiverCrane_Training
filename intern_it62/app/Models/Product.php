<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'products';
    protected $fillable = ['product_image', 'product_name'];
    public $sortable = ['product_name', 'product_id', 'product_price', 'is_sales'];

    public function scopeAllProduct()
    {
        return Product::sortable();
    }

    public function scopeName($query, $productName)
    {
        if (!is_null($productName)) {
            return $query->where('product_name', 'LIKE', '%' . $productName . '%');
        }
        return $query;
    }

    public function scopeIsSales($query, $isSales)
    {
        if (!is_null($isSales)) {
            return $query->where('is_sales', $isSales);
        }
        return $query;
    }

    public function scopeMin($query, $minPrice)
    {
        if (!is_null($minPrice) && is_numeric($minPrice)) {
            return $query->where('product_price', '>=', $minPrice);
        }
        return $query;
    }

    public function scopeMax($query, $maxPrice)
    {
        if (!is_null($maxPrice) && is_numeric($maxPrice)) {
            return $query->where('product_price', '<=', $maxPrice);
        }
        return $query;
    }
}
