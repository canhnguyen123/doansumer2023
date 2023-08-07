<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\validateRequet;
class admincontroller extends Controller
{
    public function login(){
        return  view('admin_login');
    }
    public function admin(){
        return  view('admin');
    }
    public function setting($id){
       $in4user = DB::table('tbl_staff')
            ->join('tbl_chucvu', 'tbl_staff.chucvu_id', '=', 'tbl_chucvu.chucvu_id')
            ->where('tbl_staff.id', $id)
            ->select('tbl_staff.*', 'tbl_chucvu.chucvu_name')
            ->get();
        return  view('admin_include.account.setting')->with('in4user',$in4user);
    }
    public function home(){
        
        $list_banner = DB::table("tbl_banner")
        ->where('banner_status', 1)
        ->latest() // Sắp xếp theo thứ tự mới nhất
        ->take(10) // Giới hạn số lượng kết quả là 10
        ->get();
        $today = Carbon::today();
        $countBill = DB::table('tbl_hoadon')
            ->where('status_payment_id', 4)
            ->where('created_at', '>=', $today)
            ->count();

        $countCommet = DB::table('tbl_commet')
            ->where('created_at', '>=', $today)
            ->count(); 
          $countUser = DB::table('tbl_users')
                ->where('created_at', '>=', $today)
                ->count();
        $theloai=DB::table('tbl_theloai')->where('theloai_status',1)->get();
        $count_theloai = DB::table("tbl_theloai")->where('show_home',1)->count();
        $manager_banner = view('admin_include.page.home')
            ->with('list_banner', $list_banner)
            ->with('theloai',$theloai)
            ->with('count_theloai',$count_theloai)
            ->with('countBill',$countBill)
            ->with('countCommet',$countCommet)
            ->with('countUser',$countUser);
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
        // $username = $request->input('username_nv');
        // $password = $request->input('password_nv');

        // $user = Staff::where('staff_username', $username)->first();

        // if ($user && Hash::check($password, $user->staff_password)) {
        //     Auth::guard('users')->loginUsingId($user->id, $request->has('remember'));

        //     if ($request->has('remember')) {
        //         $rememberToken = Str::random(60);
        //         Staff::where('staff_id', $user->staff_id)
        //             ->update(['remember_token' => $rememberToken]);
        //         Cookie::queue('remember_token', $rememberToken, 525600); // Lưu remember token trong cookie trong 1 năm (525600 phút)
        //     }

        //     return redirect()->route('home')->with('mess', 'Đăng nhập thành công');
        // } else {
        //     return redirect()->route('login')->with('mess', 'Sai tên đăng nhập hoặc mật khẩu');
        // }

        $username = $request->input('username_nv');
        $password = $request->input('password_nv');

        $user = DB::table('tbl_staff')->where('staff_username', $username)->first();

        if ($user && Hash::check($password, $user->staff_password)) {
          
            Auth::loginUsingId($user->id);
         
        // Truyền toàn bộ hàng trong bảng vào phiên làm việc (session)
              Session::put('user', $user);
            Session::put('id', $user->id);
              Session::put('staff_fullname', $user->staff_fullname);
              Session::put('staff_linkimg', $user->staff_linkimg);
              return redirect()->route('home')->with('mess', 'Đăng nhập thành công');
        } else {
            return redirect()->route('login')->with('mess', 'Sai tên đăng nhập hoặc mật khẩu');
        }  
        
    }
    public function viewUpdatePassword()
    {
        return  view('admin_include.account.update');
        
    }
    public function updatePassword(validateRequet $request,$id)
    {   $check = true;
        $oldPass = $request->oldPass;
        $newPass = $request->newPass;
        $anewPass = $request->anewPass;
        $user = DB::table('tbl_staff')->where('id', $id)->first();
        $password = $user->staff_password;
        $errorMessage = "Có lỗi xảy ra kiểm tra lại lỗi";
        
        if (!Hash::check($oldPass, $password)) {
            $errorMessage = "Mật khẩu không cùng với mật khẩu cũ";
            return redirect()->back()->withErrors(['oldPass' => $errorMessage]);
        } elseif ($newPass != $anewPass) {
            $errorMessage = "Xác nhận mật khẩu không cùng với mật khẩu mới";
            return redirect()->back()->withErrors(['anewPass' => $errorMessage]);
        } else {
            $data['staff_password']=bcrypt($newPass);
            DB::table('tbl_staff')->where('id', $id)->update($data);
            return " <script> alert('Cập nhật thành công'); window.location = '".route('home')."';</script>";
        }
        
    }
    public function updateShowHome(Request $request)
{
    $theloaiItem = $request->theloaiItem;

    // Get all the existing items from the database
    $allTheloai = DB::table('tbl_theloai')->get();

    // Update the show_home field based on the selected checkboxes
    foreach ($allTheloai as $item) {
        $data['show_home'] = in_array($item->theloai_id, $theloaiItem) ? 1 : 0; 
        DB::table('tbl_theloai')->where('theloai_id', $item->theloai_id)->update($data);
    }

    if (count($theloaiItem) > 4) {
        return "<script> alert('Tổng số thể loại hiển thị ở trang chủ của app không được vượt quá 4 thể loại'); window.location = '" . route('home') . "';</script>";
    } else {
        return "<script> alert('Cập nhật thành công'); window.location = '" . route('home') . "';</script>";
    }
}

        
    public function logout()
    {
        Session::forget('user');
        Auth::logout();
    
        return redirect()->route('login');
    }
    
}

