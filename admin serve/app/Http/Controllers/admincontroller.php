<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class admincontroller extends Controller
{
    public function login(){
        return  view('admin_login');
    }
    public function admin(){
        return  view('admin');
    }
    public function home(){
     
        $list_banner = DB::table("tbl_banner")
        ->where('banner_status', 1)
        ->latest() // Sắp xếp theo thứ tự mới nhất
        ->take(10) // Giới hạn số lượng kết quả là 10
        ->get();

        $manager_banner = view('admin_include.page.home')
            ->with('list_banner', $list_banner);
        return  view('admin')->with('admin_include.page.home', $manager_banner);
    }
    public function check_accountLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            Redirect::to('admin');
        }else{
            Redirect::to('admin_login');
        }
    }
    public function post_login(Request $request)
    {
        $username = $request->input('username_nv');
        $password = $request->input('password_nv');

        $user = DB::table('tbl_staff')->where('staff_name', $username)->first();

        if ($user && Hash::check($password, $user->staff_password)) {
            Auth::loginUsingId($user->id);
         
        // Truyền toàn bộ hàng trong bảng vào phiên làm việc (session)
              Session::put('user', $user);
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->route('login')->with('error', 'Sai tên đăng nhập hoặc mật khẩu');
        }  
    }

    public function logout()
    {
        Session::forget('user');
        Auth::logout();
    
        return redirect()->route('login');
    }
    
}

