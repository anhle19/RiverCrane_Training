@extends('layouts.app')

@section('heading', 'Quản lý User')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="searchNameInput" class="form-label">Tên</label>
                                <input id="searchNameInput" name="name" type="text" class="form-control mb-3"
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
                                <label for="searchGropuRoleSelect" class="form-label">Nhóm</label>
                                <select name="group_role" id="searchGropuRoleSelect" class="form-control mb-3">
                                    <option value="">--- Nhóm ---</option>
                                    <option value="Admin">Admin
                                    </option>
                                    <option value="Editor">Editor
                                    </option>
                                    <option value="Reviewer">Reviewer
                                    </option>
                                </select>
                            </div>
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
                    <div class="row mt-3">
                        <div class="col">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                <i class="fa-solid fa-plus"></i> Thêm mới</button>
                            <!-- Modal Add User -->
                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal"
                                aria-hidden="true">
                                <form action="{{ route('users_store') }}" method="post">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserModal">Thêm User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Tên</label>
                                                    <input name="name" type="text" class="form-control"
                                                        placeholder="Nhập họ và tên">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input name="email" type="text" class="form-control"
                                                        placeholder="Nhập email">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mật khẩu</label>
                                                    <input name="password" type="password" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Xác nhận</label>
                                                    <input name="confirm" type="password" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nhóm</label>
                                                    <select name="group_role" class="form-control">
                                                        <option value="">--- Nhóm ---</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Editor">Editor</option>
                                                        <option value="Reviewer">Reviewer</option>
                                                    </select>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Tạo modal edit users --}}
    @foreach ($all_users as $item)
        <!-- Modal Edit User -->
        <div class="modal fade" id="editUserModal_{{ $item->id }}" tabindex="-1"
            aria-labelledby="editUserModal_{{ $item->id }}" aria-hidden="true">
            <form action="{{ route('users_update', $item->id) }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModal">Chỉnh sửa
                                User
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tên</label>
                                <input name="name" type="text" class="form-control" value="{{ $item->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="text" class="form-control" value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật
                                    khẩu</label>
                                <input name="password" type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Xác
                                    nhận</label>
                                <input name="confirm" type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nhóm</label>
                                <select name="group_role" class="form-control">
                                    <option @if ($item->group_role == 'Admin') selected @endif value="Admin">Admin</option>
                                    <option @if ($item->group_role == 'Editor') selected @endif value="Editor">Editor
                                    </option>
                                    <option @if ($item->group_role == 'Reviewer') selected @endif value="Reviewer">Reviewer
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input @if ($item->is_active == 1) checked @endif name="is_active" type="checkbox"
                                    value="1">
                                <label class="form-label"> Đang hoạt
                                    động</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="tableCard" class="card-body">
                    @if ($users->count() == 0)
                        <span class="text-danger">Không có dữ liệu</span>
                    @else
                        <div class="table-responsive">
                            <table id="usersTable" class="table caption-top table-striped">
                                <caption id="captionTable">Hiển thị từ {{ $users->firstItem() }} ~ {{ $users->lastItem() }}
                                    trong tổng số
                                    {{ $total_users }}</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">@sortablelink('name', 'Họ và tên')</th>
                                        <th scope="col">@sortablelink('email', 'Email')</th>
                                        <th scope="col">@sortablelink('group_role', 'Nhóm')</th>
                                        <th scope="col">@sortablelink('is_active', 'Trạng thái')</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->group_role }}</td>
                                            <td>
                                                @if ($item->is_active == 1)
                                                    <span class="text-success">Đang hoạt động</span>
                                                @else
                                                    <span class="text-danger">Tạm khóa</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button id="editUserButton" type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal_{{ $item->id }}"><i
                                                            class="fa-regular fa-pen-to-square"></i></button>
                                                    <a id="deleteUserButton"
                                                        href="{{ route('users_delete', $item->id) }}" type="button"
                                                        class="btn btn-danger"
                                                        onClick="return confirm('Bạn có chắc muốn xóa thành viên {{ $item->name }} không ?');"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                    @if ($item->is_active == 1)
                                                        <a id="lockUserButton"
                                                            href="{{ route('users_lock', $item->id) }}" type="button"
                                                            class="btn btn-warning"
                                                            onClick="return confirm('Bạn có chắc muốn khóa user {{ $item->customer_name }} không ?');">
                                                            <i class="fa-solid fa-lock"></i></a>
                                                    @else
                                                        <a id="unlockUserButton"
                                                            href="{{ route('users_lock', $item->id) }}" type="button"
                                                            class="btn btn-success"
                                                            onClick="return confirm('Bạn có chắc muốn mở khóa user {{ $item->customer_name }} không ?');">
                                                            <i class="fa-solid fa-unlock"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="paginate">
                                {{ $users->appends($_GET)->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#clearSearchButton").click(function() {
                $("#searchNameInput").val('');
                $("#searchEmailInput").val('');
                $("#searchGropuRoleSelect").val('');
                $("#searchIsActiveSelect").val('');
                location.reload();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#searchBtn").click(function() {
                event.preventDefault();
                var formData = {};
                formData['name'] = $('#searchNameInput').val();
                formData['email'] = $('#searchEmailInput').val();
                formData['group_role'] = $('#searchGropuRoleSelect').val();
                formData['is_active'] = $('#searchIsActiveSelect').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('users_search') }}",
                    data: formData,
                    success: function(response) {
                        // Xóa dữ liệu cũ
                        $('#usersTable tbody').empty();
                        // Hiển thị dữ liệu mới
                        if (response.users.length == 0) {
                            $('#tableCard').empty();
                            $('#tableCard').html(
                                '<span class="text-danger">Không có dữ liệu</span>');
                        } else {
                            $('#captionTable').text('Số kết quả tìm được ' + response
                                .total_users);
                            // Lặp qua danh sách users và thêm dữ liệu vào bảng
                            $.each(response.users, function(index, user) {
                                var rowHtml = '<tr>' +
                                    '<th scope="row">' + (index + 1) + '</th>' +
                                    '<td>' + user.name + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' + user.group_role + '</td>' +
                                    '<td>';

                                if (user.is_active == 1) {
                                    rowHtml +=
                                        '<span class="text-success">Đang hoạt động</span>';
                                } else {
                                    rowHtml +=
                                        '<span class="text-danger">Tạm khóa</span>';
                                }
                                rowHtml += '</td>' +
                                    '<td>' +
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                                    '<button id="editUserButton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal_' +
                                    user.id +
                                    '"><i class="fa-regular fa-pen-to-square"></i></button>' +
                                    '<a id="deleteUserButton" href="users/delete/' +
                                    user.id +
                                    '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa thành viên ' +
                                    user.name +
                                    ' không ?\');"><i class="fa-solid fa-trash"></i></a>';
                                if (user.is_active == 1) {
                                    rowHtml +=
                                        '<a id="lockUserButton" href="users/lock/' +
                                        user.id +
                                        '" type="button" class="btn btn-warning" onClick="return confirm(\'Bạn có chắc muốn khóa thành viên ' +
                                        user.name +
                                        ' không ?\');"><i class="fa-solid fa-lock"></i></a>';
                                } else {
                                    rowHtml +=
                                        '<a id="lockUserButton" href="users/lock/' +
                                        user.id +
                                        '" type="button" class="btn btn-success" onClick="return confirm(\'Bạn có chắc muốn mở khóa thành viên ' +
                                        user.name +
                                        ' không ?\');"><i class="fa-solid fa-unlock"></i></a>';
                                }

                                rowHtml += '</div>' +
                                    '</td>' +
                                    '</tr>';
                                $('#usersTable tbody').append(rowHtml);
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
            formData['name'] = $('#searchNameInput').val();
            formData['email'] = $('#searchEmailInput').val();
            formData['group_role'] = $('#searchGropuRoleSelect').val();
            formData['is_active'] = $('#searchIsActiveSelect').val();
            $.ajax({
                url: "{{ route('users_search') }}" + '?page=' + page,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('#usersTable tbody').empty();
                    $.each(response.users, function(index, user) {
                        var rowHtml = '<tr>' +
                            '<th scope="row">' + (index + 1) + '</th>' +
                            '<td>' + user.name + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.group_role + '</td>' +
                            '<td>';

                        if (user.is_active == 1) {
                            rowHtml +=
                                '<span class="text-success">Đang hoạt động</span>';
                        } else {
                            rowHtml +=
                                '<span class="text-danger">Tạm khóa</span>';
                        }
                        rowHtml += '</td>' +
                            '<td>' +
                            '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">' +
                            '<button id="editUserButton" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal_' +
                            user.id +
                            '"><i class="fa-regular fa-pen-to-square"></i></button>' +
                            '<a id="deleteUserButton" href="users/delete/' +
                            user.id +
                            '" type="button" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc muốn xóa thành viên ' +
                            user.name +
                            ' không ?\');"><i class="fa-solid fa-trash"></i></a>';
                        if (user.is_active == 1) {
                            rowHtml +=
                                '<a id="lockUserButton" href="users/lock/' +
                                user.id +
                                '" type="button" class="btn btn-warning" onClick="return confirm(\'Bạn có chắc muốn khóa thành viên ' +
                                user.name +
                                ' không ?\');"><i class="fa-solid fa-lock"></i></a>';
                        } else {
                            rowHtml +=
                                '<a id="lockUserButton" href="users/lock/' +
                                user.id +
                                '" type="button" class="btn btn-success" onClick="return confirm(\'Bạn có chắc muốn mở khóa thành viên ' +
                                user.name +
                                ' không ?\');"><i class="fa-solid fa-unlock"></i></a>';
                        }

                        rowHtml += '</div>' +
                            '</td>' +
                            '</tr>';
                        $('#usersTable tbody').append(rowHtml);
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
@endsection
