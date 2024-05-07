<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::allUser()->paginate(10);
        $all_users = User::allUser()->get();
        // Gọi đến view có dữ liệu danh sách user
        $total_users = User::count();
        return view('users', compact('users', 'all_users', 'total_users'));
    }

    public function search(Request $request)
    {
        $users = User::where('is_delete', 0)
        ->name($request->name)
        ->email($request->email)
        ->groupRole($request->group_role)
        ->active($request->is_active)
        ->orderBy('id', 'desc')->paginate(10);
        $total_users = $users->total();
        // Tạo HTML phân trang từ view 'users.blade.php'
        $pagination = $users->appends($request->except('page'))->links()->toHtml();
        return response()->json([
            'success' => true,
            'users' => $users->items(),
            'total_users' => $total_users,
            'pagination' => $pagination
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        // Lưu dữ liệu
        $obj = new User();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = Hash::make($request->password);
        $obj->group_role = $request->group_role;
        if (isset($request->is_active)) {
            $obj->is_active = $request->is_active;
        } else {
            $obj->is_active = 0;
        }
        $obj->is_delete = 0;
        $obj->save();

        return redirect()->back()->with('success', 'Thêm thành công');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $request->safe()->except(['password']);
        $user = User::find($id);
        // Trong trường hợp cập nhật mật khẩu
        if ($request->password != null) {
            $request->safe()->only(['password']);
            $user->password = Hash::make($request->password);
        }
        // Cập nhật dữ liệu
        $user->name = $request->name;
        $user->email = $request->email;
        $user->group_role = $request->group_role;
        if (isset($request->is_active)) {
            $user->is_active = $request->is_active;
        } else {
            $user->is_active = 0;
        }
        $user->update();

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        if ($id == Auth::user()->id) {
            $user = User::find($id);
            $user->is_delete = 1;
            $user->update();
        }
        // Thay dữ liệu cột is_delete
        $user = User::find($id);
        $user->is_delete = 1;
        $user->update();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function lock($id)
    {
        $user = User::find($id);
        // Thay dữ liệu cột is_active
        if ($user->is_active == 1) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->update();

        return redirect()->back()->with('success', 'Khóa/Mở khóa thành công');
    }
}
