@extends('layouts.app')

@section('heading', 'Quản lý Customer')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="searchNameInput" class="form-label">Tên</label>
                                <input id="searchNameInput" name="customer_name" type="text" class="form-control mb-3"
                                    placeholder="Nhập họ tên" value="">
                            </div>
                            <div class="mb-3">
                                <label for="searchEmailInput" class="form-label">Email</label>
                                <input id="searchEmailInput" name="email" type="text" class="form-control mb-3"
                                    placeholder="Nhập email" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="searchIsActiveSelect" class="form-label">Trạng thái</label>
                                <select name="is_active" id="searchIsActiveSelect" class="form-control mb-3">
                                    <option value="">--- Trạng thái ---</option>
                                    <option value="1">Đang hoạt động
                                    </option>
                                    <option value="0">Tạm khóa
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="searchAddressInput" class="form-label">Địa chỉ</label>
                                <input id="searchAddressInput" name="address" type="text" class="form-control mb-3"
                                    placeholder="Nhập địa chỉ" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button id="searchButton" type="button" class="btn btn-primary"><i
                                    class="fa-solid fa-magnifying-glass"></i>
                                Tìm kiếm</button>
                            <a href="#" id="clearSearchButton" type="button" class="btn btn-primary"><i
                                    class="fa-solid fa-eraser"></i> Xóa tìm kiếm</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCustomerModal">
                                <i class="fa-solid fa-plus"></i> Thêm mới
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#importCustomerModal">
                                <i class="fa-solid fa-file-import"></i> Import Excel
                            </button>
                            <div class="row mt-3">
                                <form action="{{ route('customers_export') }}" method="get">
                                    <input id="exportName" type="hidden" name="customer_name" value="">
                                    <input id="exportEmail" type="hidden" name="email" value="">
                                    <input id="exportIsActive" type="hidden" name="is_active" value="">
                                    <input id="exportAddress" type="hidden" name="address" value="">
                                    <button id="exportBtn" type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-file-export"></i> Export Excel
                                    </button>
                                </form>
                            </div>
                            <!-- Modal Add Customer -->
                            <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModal"
                                aria-hidden="true">
                                <form action="{{ route('customers_store') }}" method="post">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserModal">Thêm Customer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Tên</label>
                                                    <input name="customer_name" type="text" class="form-control"
                                                        placeholder="Nhập họ và tên">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input name="email" type="text" class="form-control"
                                                        placeholder="Nhập email">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Điện thoại</label>
                                                    <input name="tel_num" type="text" class="form-control"
                                                        placeholder="Nhập số điện thoại">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Địa chỉ</label>
                                                    <input name="address" type="text" class="form-control"
                                                        placeholder="Nhập địa chỉ">
                                                </div>
                                                <div class="mb-3">
                                                    <input name="is_active" type="checkbox" value="1">
                                                    <label class="form-label"> Đang hoạt động</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Modal Import CSV -->
                            <div class="modal fade" id="importCustomerModal" tabindex="-1"
                                aria-labelledby="importCustomerModal" aria-hidden="true">
                                <form action="{{ route('customers_import') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importCustomerModal">Import Excel</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">File xlsx,xls</label>
                                                    <input name="file" type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                    @if ($customers->count() == 0)
                        <span class="text-danger">Không có dữ liệu</span>
                    @else
                        <div class="table-responsive">
                            <table id="customersTable" class="table caption-top table-striped">
                                <caption id="captionTable">Hiển thị từ {{ $customers->firstItem() }} ~
                                    {{ $customers->lastItem() }} trong
                                    tổng số
                                    {{ $customers->total() }}</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">@sortablelink('customer_name', 'Họ và tên')</th>
                                        <th scope="col">@sortablelink('email', 'Email')</th>
                                        <th scope="col">@sortablelink('tel_num', 'Điện thoại')</th>
                                        <th scope="col">@sortablelink('address', 'Địa chỉ')</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $item)
                                        <tr data-customer-id="{{ $item->id }}">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="editable" data-field="customer_name">{{ $item->customer_name }}
                                            </td>
                                            <td class="editable" data-field="email">{{ $item->email }}</td>
                                            <td class="editable" data-field="tel_num">{{ $item->tel_num }}</td>
                                            <td class="editable" data-field="address">{{ $item->address }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button id="editUserButton" type="button"
                                                        class="btn btn-primary edit-btn"><i
                                                            class="fa-regular fa-pen-to-square"></i></button>
                                                    <a id="deleteUserButton"
                                                        href="{{ route('customers_delete', $item->id) }}" type="button"
                                                        class="btn btn-danger"
                                                        onClick="return confirm('Bạn có chắc muốn xóa khách hàng {{ $item->customer_name }} không ?');"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                    @if ($item->is_active == 1)
                                                        <a id="lockUserButton"
                                                            href="{{ route('customers_lock', $item->id) }}"
                                                            type="button" class="btn btn-warning"
                                                            onClick="return confirm('Bạn có chắc muốn khóa khách hàng {{ $item->customer_name }} không ?');">
                                                            <i class="fa-solid fa-lock"></i></a>
                                                    @else
                                                        <a id="unlockUserButton"
                                                            href="{{ route('customers_lock', $item->id) }}"
                                                            type="button" class="btn btn-success"
                                                            onClick="return confirm('Bạn có chắc muốn mở khóa khách hàng {{ $item->customer_name }} không ?');">
                                                            <i class="fa-solid fa-unlock"></i></a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="paginate">
                                {{ $customers->appends($_GET)->links() }}
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
                $("#searchEmailInput").val('');
                $("#searchAddressInput").val('');
                $("#searchIsActiveSelect").val('');
                location.reload()
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            /***
             * Xử lý chuyển button edit thành button save
             * Chuyển các ô trong dòng trở thành input
             * Lấy dữ liệu từ dòng hiển thị lên input
             * */
            $(document).on('click', '.edit-btn', function() {
                var row = $(this).closest('tr');
                var editCells = row.find('.editable');

                editCells.each(function() {
                    var currentValue = $(this).text().trim();
                    $(this).html('<input type="text" value="' + currentValue + '">');
                });

                $(this).html('<i class="fa-solid fa-check"></i>').removeClass('edit-btn').addClass(
                    'save-btn');
            });

            /**
             * Xử lý button save
             * Chuyển button save thành button edit
             * Set dữ liệu mới cho dòng trong table
             * Gửi dữ liệu được cập nhật bằng ajax để lưu
             * **/
            $(document).on('click', '.save-btn', function() {
                var id = $(this).closest('tr').data('customer-id');
                var row = $(this).closest('tr');
                var editCells = row.find('.editable');
                var newData = {};

                //Duyệt từng cột của dòng được edit và set dữ liệu mới lên
                editCells.each(function() {
                    //Lấy ra tên cột
                    var fieldName = $(this).data('field');
                    //Lấy ra dữ liệu
                    var newValue = $(this).find('input').val();
                    newData[fieldName] = newValue;
                    $(this).text(newValue);
                });

                // Thực hiện gửi yêu cầu Ajax để cập nhật dữ liệu trên máy chủ
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "/intern_it62/intern_it62/customers/update/" + id,
                    data: newData,
                    dataType: 'json',
                    success: function(response) {
                        iziToast.success({
                            title: '',
                            position: 'topRight',
                            message: response.message
                        });
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: '',
                            position: 'topRight',
                            message: 'Dữ liệu không hợp lệ hoặc có lỗi'
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 5000);

                    }
                });

                $(this).html('<i class="fa-regular fa-pen-to-square"></i>').removeClass('save-btn')
                    .addClass('edit-btn');
            });


        });
    </script>

    {{-- Gửi request đến controller và nhận lại danh sách customer
    Cập nhật table --}}
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function(event) {
                event.preventDefault();
                var formData = {};
                formData['customer_name'] = $('#searchNameInput').val();
                formData['email'] = $('#searchEmailInput').val();
                formData['is_active'] = $('#searchIsActiveSelect').val();
                formData['address'] = $('#searchAddressInput').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('customers_search') }}",
                    data: formData,
                    success: function(response) {
                        // Xóa dữ liệu cũ
                        $('#customersTable tbody').empty();
                        // Hiển thị dữ liệu mới
                        if (response.customers.length == 0) {
                            $('#tableCard').empty();
                            $('#tableCard').html(
                                '<span class="text-danger">Không có dữ liệu</span>');
                        } else {
                            $('#captionTable').text('Số kết quả tìm được ' + response
                                .total_customers);
                            $.each(response.customers, function(index, item) {
                                var html = '<tr data-customer-id="' + item.id + '">' +
                                    '<th scope="row">' + (index + 1) + '</th>' +
                                    '<td class="editable" data-field="customer_name">' +
                                    item.customer_name + '</td>' +
                                    '<td class="editable" data-field="email">' + item
                                    .email + '</td>' +
                                    '<td class="editable" data-field="tel_num">' + item
                                    .tel_num + '</td>' +
                                    '<td class="editable" data-field="address">' + item
                                    .address + '</td>' +
                                    '<td>' +
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                                    '<button id="editUserButton" type="button" class="btn btn-primary edit-btn">' +
                                    '<i class="fa-regular fa-pen-to-square"></i>' +
                                    '</button>' +
                                    '<a id="deleteUserButton" href="customers/delete/' +
                                    item.id +
                                    '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa khách hàng ' +
                                    item.customer_name + ' không ?\');">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                    '</a>';
                                if (item.is_active == 1) {
                                    html +=
                                        '<a id="lockUserButton" href="customers/lock/' +
                                        item.id +
                                        '" type="button" class="btn btn-warning" onClick="return confirm(\'Bạn có chắc muốn khóa khách hàng ' +
                                        item.customer_name + ' không ?\');">' +
                                        '<i class="fa-solid fa-lock"></i>' +
                                        '</a>';
                                } else {
                                    html +=
                                        '<a id="unlockUserButton" href="customers/lock/' +
                                        item.id +
                                        '" type="button" class="btn btn-success" onClick="return confirm(\'Bạn có chắc muốn mở khóa khách hàng ' +
                                        item.customer_name + ' không ?\');">' +
                                        '<i class="fa-solid fa-unlock"></i>' +
                                        '</a>';
                                }
                                html += '</div>' +
                                    '</td>' +
                                    '</tr>';
                                $('#customersTable tbody').append(html);
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
                })
            });
        });
    </script>

    <script>
        function fetchPageData(page) {
            var formData = {};
            formData['customer_name'] = $('#searchNameInput').val();
            formData['email'] = $('#searchEmailInput').val();
            formData['is_active'] = $('#searchIsActiveSelect').val();
            formData['address'] = $('#searchAddressInput').val();
            $.ajax({
                url: "{{ route('customers_search') }}" + '?page=' + page,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('#customersTable tbody').empty();
                    $.each(response.customers, function(index, item) {
                        var html = '<tr data-customer-id="' + item.id + '">' +
                            '<th scope="row">' + (index + 1) + '</th>' +
                            '<td class="editable" data-field="customer_name">' +
                            item.customer_name + '</td>' +
                            '<td class="editable" data-field="email">' + item
                            .email + '</td>' +
                            '<td class="editable" data-field="tel_num">' + item
                            .tel_num + '</td>' +
                            '<td class="editable" data-field="address">' + item
                            .address + '</td>' +
                            '<td>' +
                            '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                            '<button id="editUserButton" type="button" class="btn btn-primary edit-btn">' +
                            '<i class="fa-regular fa-pen-to-square"></i>' +
                            '</button>' +
                            '<a id="deleteUserButton" href="customers/delete/' +
                            item.id +
                            '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa khách hàng ' +
                            item.customer_name + ' không ?\');">' +
                            '<i class="fa-solid fa-trash"></i>' +
                            '</a>';
                        if (item.is_active == 1) {
                            html +=
                                '<a id="lockUserButton" href="customers/lock/' +
                                item.id +
                                '" type="button" class="btn btn-warning" onClick="return confirm(\'Bạn có chắc muốn khóa khách hàng ' +
                                item.customer_name + ' không ?\');">' +
                                '<i class="fa-solid fa-lock"></i>' +
                                '</a>';
                        } else {
                            html +=
                                '<a id="unlockUserButton" href="customers/lock/' +
                                item.id +
                                '" type="button" class="btn btn-success" onClick="return confirm(\'Bạn có chắc muốn mở khóa khách hàng ' +
                                item.customer_name + ' không ?\');">' +
                                '<i class="fa-solid fa-unlock"></i>' +
                                '</a>';
                        }
                        html += '</div>' +
                            '</td>' +
                            '</tr>';
                        $('#customersTable tbody').append(html);
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

    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                var searchData = {};
                searchData['customer_name'] = $('#searchNameInput').val();
                searchData['email'] = $('#searchEmailInput').val();
                searchData['is_active'] = $('#searchIsActiveSelect').val();
                searchData['address'] = $('#searchAddressInput').val();

                $('#exportName').val(searchData['customer_name']);
                $('#exportEmail').val(searchData['email']);
                $('#exportIsActive').val(searchData['is_active']);
                $('#exportAddress').val(searchData['address']);
            });
        });
    </script>
@endsection
