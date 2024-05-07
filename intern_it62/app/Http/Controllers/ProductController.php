<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::allProduct()->paginate(10);
        return view('products', compact('products'));
    }

    public function search(Request $request)
    {
        if (is_numeric($request->min_price) || is_numeric($request->max_price)) {
            if ($request->min_price > $request->max_price) {
                return response()->json(['error' => 'Giá không hợp lệ']);
            }
        } elseif (!empty($request->min_price) || !empty($request->max_price)) {
            if (!is_numeric($request->min_price) || !is_numeric($request->max_price)) {
                return response()->json(['error' => 'Giá không hợp lệ']);
            }
        }
        $products = Product::name($request->product_name)
                        ->isSales($request->is_sales)
                        ->min($request->min_price)
                        ->max($request->max_price)
                        ->orderBy('id', 'desc')->paginate(10);
        $pagination = $products->appends($request->except('page'))->links()->toHtml();
        $total_products = $products->total();
        return response()->json([
            'success' => true,
            'products' => $products->items(),
            'total_products' => $total_products,
            'pagination' => $pagination
        ]);
    }

    public function add()
    {
        return view('product_add');
    }

    public function store(StoreProductRequest $request)
    {
        $request->safe()->except(['product_image']);
        $obj = new Product();
        if ($request->hasFile('product_image')) {
            $request->safe()->only(['product_image']);
            $ext = $request->file('product_image')->extension();
            $final_name = 'product_image' . '.' . time() . '.' . $ext;
            $request->file('product_image')->move(public_path('uploads/'), $final_name);
            $obj->product_image = $final_name;
        }

        $obj->product_name = $request->product_name;
        $obj->product_id = substr($request->product_name, 0, 1) . str_pad(Product::count() + 1, 9, '0', STR_PAD_LEFT);
        $obj->product_price = $request->product_price;
        $obj->is_sales = $request->is_sales;
        $obj->description = $request->description;
        $obj->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product_edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $request->safe()->except(['product_image']);
        $obj = Product::find($id);
        if ($request->hasFile('product_image')) {
            $request->safe()->only(['product_image']);
            $ext = $request->file('product_image')->extension();
            $final_name = 'product_image' . '.' . time() . '.' . $ext;
            $request->file('product_image')->move(public_path('uploads/'), $final_name);
            $obj->product_image = $final_name;
        }
        $obj->product_name = $request->product_name;
        $obj->product_price = $request->product_price;
        $obj->is_sales = $request->is_sales;
        $obj->description = $request->description;
        $obj->update();
        return redirect()->route('products')->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->product_image != null) {
            unlink(public_path('uploads/' . $product->product_image));
        }
        $product->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function deleteImage(Request $request)
    {
        $obj = Product::find($request->id);
        unlink(public_path('uploads/' . $obj->product_image));
        $obj->product_image = '';
        $obj->update();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
