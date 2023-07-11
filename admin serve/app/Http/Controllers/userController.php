<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;


class userController extends Controller
{
    public function user_list()
    {
        $list_user = DB::table("tbl_users")->paginate(20); // Số lượng mục trên mỗi trang là 20
        $count = DB::table("tbl_users")->count();
        $manager_user = view('admin_include.page.user.list')
            ->with('list_user', $list_user)
            ->with('count', $count);
        return view('admin')->with('admin_include.page.user.list', $manager_user);
    }
    public function user_deatil($user_id)
    {
        $deatil_user = DB::table("tbl_users")->where('user_id',$user_id) ->get();
        $manager_user = view('admin_include.page.user.deatil')
            ->with('deatil_user', $deatil_user);
        return  view('admin')->with('admin_include.page.user.deatil', $manager_user);
    }
    public function togggle_status($user_id, $user_status){
        $product=DB::table('tbl_users')->where('user_id',$user_id)->first();
        $status=0;
        $data=[];
        if($product->user_status==1){
            if($user_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->user_status == 0) {
            if($user_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['user_status']=$status;
        DB::table('tbl_users')->where('user_id',$user_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('user_list')."';</script>";
    }
}
