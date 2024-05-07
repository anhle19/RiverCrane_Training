@extends('layouts.app')

@section('heading', 'Thêm Product')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm*</label>
                                    <input name="product_name" type="text" class="form-control mb-3"
                                        placeholder="Nhập tên sản phẩm" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá bán*</label>
                                    <input name="product_price" type="text" class="form-control mb-3"
                                        placeholder="Nhập giá sản phẩm" value="">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái*</label>
                                    <select name="is_sales" id="searchIsActiveSelect" class="form-control mb-3">
                                        <option value="1">Đang bán
                                        </option>
                                        <option value="0">Dừng bán
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mô tả</label>
                                    <textarea class="form-control" name="description" style="height: 130px" cols="100" rows="100"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh</label>
                                    <input class="form-control w_300" type="file" name="product_image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="btn btn-success" type="submit" value="Thêm mới">
                                <a href="{{ route('products') }}" class="btn btn-danger" type="button">Hủy</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
