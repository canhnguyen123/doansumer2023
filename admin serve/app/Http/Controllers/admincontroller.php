<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
session_start();
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
        $credentials = $request->only('username_nv', 'password_nv');
    
        $result = DB::table('tbl_staff')
            ->where('staff_name', $credentials['username_nv'])
            ->first();
    
        if ($result && Hash::check($credentials['password_nv'], $result->staff_password)) {
            // Authentication successful
            return " <script> alert('Đăng nhập'); window.location = '".route('home')."';</script>";
        
            // return redirect()->route('home');
        } else {
            // Authentication failed
            Session::put("mess", "Sai tài khoản hoặc mật khẩu");
            return redirect()->route('login');
        }
    }
    
    public function logout(){
        Session::put('fullname_nv',null);
        Session::put("id_nv",null);
        return Redirect::to('/admin/login-admin');
    }
    
}

