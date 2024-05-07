@extends('layouts.app')

@section('heading', 'Quản lý Product')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products') }}" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="searchNameInput" class="form-label">Tên sản phẩm</label>
                                    <input id="searchNameInput" name="product_name" type="text" class="form-control mb-3"
                                        placeholder="Nhập tên sản phẩm" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="searchIsSalesSelect" class="form-label">Trạng thái</label>
                                    <select name="is_sales" id="searchIsSalesSelect" class="form-control mb-3">
                                        <option value="">--- Trạng
                                            thái ---</option>
                                        <option value="1">Đang bán
                                        </option>
                                        <option value="0">Dừng bán
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="searchMinPriceInput" class="form-label">Giá bán từ</label>
                                    <input id="searchMinPriceInput" class="form-control w_200" type="text"
                                        name="min_price" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="searchMaxPriceInput" class="form-label">Giá bán đến</label>
                                    <input id="searchMaxPriceInput" class="form-control w_200" type="text"
                                        name="max_price" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button id="searchBtn" type="button" class="btn btn-primary"><i
                                        class="fa-solid fa-magnifying-glass"></i>
                                    Tìm kiếm</button>
                                <a href="#" id="clearSearchButton" type="button" class="btn btn-primary"><i
                                        class="fa-solid fa-eraser"></i> Xóa tìm kiếm</a>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col">
                            <a href="{{ route('products_add') }}" type="button" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="tableCard" class="card-body">
                    @if ($products->count() == 0)
                        <span class="text-danger">Không có dữ liệu</span>
                    @else
                        <div class="table-responsive">
                            <table id="productsTable" class="table caption-top table-striped">
                                <caption id="captionTable">Hiển thị từ {{ $products->firstItem() }} ~
                                    {{ $products->lastItem() }} trong tổng
                                    số
                                    {{ $products->total() }}</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">@sortablelink('product_id', 'Mã sản phẩm')</th>
                                        <th scope="col">@sortablelink('product_name', 'Tên sản phẩm')</th>
                                        <th scope="col">@sortablelink('description', 'Mô tả')</th>
                                        <th scope="col">@sortablelink('product_price', 'Giá bán')</th>
                                        <th scope="col">@sortablelink('is_sales', 'Trạng thái')</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="mytooltip">
                                                <span class="tooltip-item">{{ $item->product_id }}</span>
                                                @if ($item->product_image != null)
                                                    <span class="tooltip-content">
                                                        <img src="{{ asset('public/uploads/' . $item->product_image) }}"
                                                            alt="Product Image">
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>${{ $item->product_price }}</td>
                                            <td>
                                                @if ($item->is_sales == 1)
                                                    <span class="text-success">Đang bán</span>
                                                @else
                                                    <span class="text-danger">Dừng bán</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <a href="{{ route('products_edit', $item->id) }}" id="editUserButton"
                                                        type="button" class="btn btn-primary"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                    <a id="deleteUserButton"
                                                        href="{{ route('products_delete', $item->id) }}" type="button"
                                                        class="btn btn-danger"
                                                        onClick="return confirm('Bạn có chắc muốn xóa sản phẩm {{ $item->name }} không ?');"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="paginate">
                                {{ $products->appends($_GET)->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Xóa dữ liệu form tìm kiếm
            $("#clearSearchButton").click(function() {
                $("#searchNameInput").val('');
                $("#searchIsSalesSelect").val('');
                $("#searchMinPriceInput").val('');
                $("#searchMaxPriceSelect").val('');
                location.reload()
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#searchBtn").click(function() {
                event.preventDefault();
                var formData = {};
                formData['product_name'] = $('#searchNameInput').val();
                formData['is_sales'] = $('#searchIsSalesSelect').val();
                formData['min_price'] = $('#searchMinPriceInput').val();
                formData['max_price'] = $('#searchMaxPriceInput').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('products_search') }}",
                    data: formData,
                    success: function(response) {
                        // Xóa dữ liệu cũ
                        $('#productsTable tbody').empty();
                        // Hiển thị dữ liệu mới
                        if (response.total_products == 0 || response.total_products ==
                            undefined) {
                            var message = 'Không tìm thấy, hoặc dữ liệu không hợp lệ';
                            if (response.error != null) message = response.error
                            iziToast.error({
                                title: '',
                                position: 'topRight',
                                message: message
                            });
                            $('#tableCard').empty();
                            $('#tableCard').html(
                                '<span class="text-danger">Không có dữ liệu</span>');
                        } else {
                            $('#captionTable').text('Số kết quả tìm được ' + response
                                .total_products);
                            // Lặp qua danh sách users và thêm dữ liệu vào bảng
                            // Lặp qua danh sách sản phẩm và cập nhật dữ liệu trong bảng
                            $.each(response.products, function(index, product) {
                                var row = '<tr>' +
                                    '<th scope="row">' + (index + 1) + '</th>' +
                                    '<td class="mytooltip">' +
                                    '<span class="tooltip-item">' + product.product_id;
                                if (product.product_image != "") {
                                    row += '<span class="tooltip-content">' +
                                        '<img src="http://adminrivercrane.test/public/uploads/' + product.product_image + '" alt="Product Image">' +
                                        '</span>';
                                }
                                row += '</span>' +
                                    '</td>' +
                                    '<td>' + product.product_name + '</td>' +
                                    '<td>' + product.description + '</td>' +
                                    '<td>$' + product.product_price + '</td>' +
                                    '<td>';

                                if (product.is_sales == 1) {
                                    row += '<span class="text-success">Đang bán</span>';
                                } else {
                                    row += '<span class="text-danger">Dừng bán</span>';
                                }

                                row += '</td>' +
                                    '<td>' +
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                                    '<a href="products/edit/' + product.id +
                                    '" id="editProductButton" type="button" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>' +
                                    '<a id="deleteProductButton" href="products/delete/' +
                                    product.id +
                                    '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa sản phẩm ' +
                                    product.product_name +
                                    ' không ?\');"><i class="fa-solid fa-trash"></i></a>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';

                                // Thêm dòng vào bảng
                                $('#productsTable tbody').append(row);
                                $('#paginate').empty();
                                $('#paginate').html(response.pagination);
                                $(document).on('click', '.pagination a', function(
                                event) {
                                    event.preventDefault();
                                    var page = $(this).attr('href').split(
                                        'page=')[1];
                                    fetchPageData(page);
                                });
                            });
                        };
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function fetchPageData(page) {
            var formData = {};
            formData['product_name'] = $('#searchNameInput').val();
            formData['is_sales'] = $('#searchIsSalesSelect').val();
            formData['min_price'] = $('#searchMinPriceInput').val();
            formData['max_price'] = $('#searchMaxPriceInput').val();
            $.ajax({
                url: "{{ route('products_search') }}" + '?page=' + page,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('#productsTable tbody').empty();
                    $.each(response.products, function(index, product) {
                        var row = '<tr>' +
                            '<th scope="row">' + (index + 1) + '</th>' +
                            '<td class="mytooltip">' +
                            '<span class="tooltip-item">' + product.product_id;
                        if (product.product_image != "") {
                            row += '<span class="tooltip-content">' +
                                '<img src="http://adminrivercrane.test/public/uploads/' + product.product_image + '" alt="Product Image">' +
                                '</span>';
                        }
                        row += '</span>' +
                            '</td>' +
                            '<td>' + product.product_name + '</td>' +
                            '<td>' + product.description + '</td>' +
                            '<td>$' + product.product_price + '</td>' +
                            '<td>';

                        if (product.is_sales == 1) {
                            row += '<span class="text-success">Đang bán</span>';
                        } else {
                            row += '<span class="text-danger">Dừng bán</span>';
                        }

                        row += '</td>' +
                            '<td>' +
                            '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                            '<a href="products/edit/' + product.id +
                            '" id="editProductButton" type="button" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>' +
                            '<a id="deleteProductButton" href="products/delete/' +
                            product.id +
                            '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa sản phẩm ' +
                            product.product_name +
                            ' không ?\');"><i class="fa-solid fa-trash"></i></a>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';

                        // Thêm dòng vào bảng
                        $('#productsTable tbody').append(row);
                        $('#paginate').empty();
                        $('#paginate').html(response.pagination);
                    });
                },
                error: function(error) {
                    // Xử lý lỗi nếu có
                    console.log(error);
                }
            });
        }
    </script>

    <style>
        .mytooltip .tooltip-item {
            cursor: pointer;
            display: inline-block;
        }

        .mytooltip .tooltip-content {
            visibility: hidden;
            position: absolute;
            z-index: 9999;
            width: auto;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #2b2b2b;
            box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mytooltip .tooltip-content img {
            height: 300px;
            display: block;
        }

        .mytooltip:hover .tooltip-content {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endsection
