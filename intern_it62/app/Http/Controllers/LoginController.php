<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    /*
    * Kiểm tra dữ liệu input trước khi đăng nhập
    * Kiểm tra dữ liệu trong database
    */
    public function submit(LoginRequest $request)
    {
        $credesstials = [
            'email' => $request->email,
            'password' => $request->password,
            'group_role' => 'Admin'
        ];

        // Nếu login thành công sẽ lưu lại thời gian và ip login
        $user_data = User::where('email', $request->email)->first();
        if ($request->remember != null) {
            if (Auth::attempt($credesstials, $request->get('remember'))) {
                $user_data->last_login_at = Carbon::createFromTimestamp(time())->toDateTimeString();
                $user_data->last_login_ip = $request->ip();
                $user_data->update();
                return redirect()->route('users');
            }
        } else {
            if (Auth::attempt($credesstials)) {
                $user_data->last_login_at = Carbon::createFromTimestamp(time())->toDateTimeString();
                $user_data->last_login_ip = $request->ip();
                $user_data->update();
                return redirect()->route('users');
            }
        }
        return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
