<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validateRequet;

class userController extends Controller
{
    public function user_list()
    {
        $list_user = DB::table("tbl_users")->paginate(10); // Số lượng mục trên mỗi trang là 20
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
            ->with('deatil_user', $deatil_user)
            ->with('user_id', $user_id);
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
    public function update_money(validateRequet $request,$user_id){
        $check_oldMoney=DB::table('tbl_users')->where('user_id',$user_id)->first();
        $odl_money=$check_oldMoney->user_monney;
        $user_moneynew = $request->user_money;
        
        $user_money=$user_moneynew+$odl_money;
        $data['user_monney']=$user_money;

         $update=DB::table('tbl_users')->where('user_id',$user_id)->update($data);
        if($update){
            $data1['user_id']=$user_id;
            $data1['mess_category']="add money";
            $data1['mess_content']="Quản trị viên đã thêm ".$user_moneynew." .Hiện tại tài khoản của bạn là ".$user_money.".";
            $data1['mess_status']=1;
            $data1['created_at']= Carbon::now();
            $insert=DB::table('tbl_mess')->insert($data1);
            if($insert){
                return " <script> alert('Đã nạp thành công'); window.location = '".route('user_list')."';</script>";
            }
            else{
                return " <script> alert('Đã nạp thất bại'); window.location = '".route('user_deatil',['user_id'=>$user_id])."';</script>";
            }
        }else{
            return " <script> alert('Đã nạp thất bại'); window.location = '".route('user_deatil',['user_id'=>$user_id])."';</script>";
        }
      }
}
