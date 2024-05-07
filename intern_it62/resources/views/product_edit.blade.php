@extends('layouts.app')

@section('heading', 'Cập nhật Product')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products_update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm*</label>
                                    <input name="product_name" type="text" class="form-control mb-3"
                                        value="{{ $product->product_name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá bán*</label>
                                    <input name="product_price" type="text" class="form-control mb-3"
                                        value="{{ $product->product_price }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái*</label>
                                    <select name="is_sales" id="searchIsActiveSelect" class="form-control mb-3">
                                        <option @if ($product->is_sales == 1)
                                            selected
                                        @endif value="1">Đang bán
                                        </option>
                                        <option @if ($product->is_sales == 0)
                                            selected
                                        @endif value="0">Dừng bán
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mô tả</label>
                                        <textarea class="form-control" name="description" style="height: 130px" cols="100" rows="100">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh</label> <br>
                                    @if ($product->product_image != null)
                                    <div id="productImage">
                                        <img class="profile-photo w_400" src="{{ asset('public/uploads/'.$product->product_image) }}" alt=""> <br>
                                        <button data-product-id="{{ $product->id }}" id="deleteImageBtn" class="btn btn-danger mt-2 mb-2">Xóa hình ảnh</button> 
                                    </div>
                                    @endif
                                    <input class="form-control w_300" type="file" name="product_image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="btn btn-success" type="submit" value="Cập nhật">
                                <a href="{{ route('products') }}" class="btn btn-danger" type="button">Hủy</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deleteImageBtn').click(function(){
                $('#productImage').empty();
                var formdata = {};
                formdata['id'] = {{ $product->id }};
                $.ajax({
                    type: 'GET',
                    url: '/intern_it62/intern_it62/products/delete-image',
                    data: formdata,
                    dataType: 'json',
                    success: function(response) {
                        iziToast.success({
                            title: '',
                            position: 'topRight',
                            message: response.message
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(jqXHR.responseText);
                    }
                })
            });
        });
    </script>
@endsection
