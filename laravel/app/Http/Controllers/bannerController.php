<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Product_classRequest;
session_start();

class bannerController extends Controller
{
    public function banner_list(){
        $list_banner=DB::table("tbl_banner")->get();
        $count=DB::table("tbl_banner")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_banner=view('admin_include.page.banner.list')
        ->with('list_banner',$list_banner)
        ->with('count',$count) ;
        return  view('admin')->with('admin_include.page.banner.list',$manager_banner);
    }
    public function banner_add(){
        return  view('admin_include.page.banner.add');
    }
    public function post_banner_add(Request $request){
       $data=[];
      $banner_img = $request->input("banner_img");
    //$banner_img = '312312';
       $banner_mota = $request->input("banner_mota");
      
   ///Thêm dl vào csdl
       $data['banner_link']=$banner_img;
       $data['banner_node']=$banner_mota;
    // $data['banner_code']="banner quảng cáo";
         $data['banner_status']=0;
       $data['created_at'] = Carbon::now();
         $inserted=   DB::table('tbl_banner')->insert($data);
       
       if ($inserted) {
        return response()->json(['success' => true, 'message' => 'Thêm thành công']);
    } else {
        return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
    }
     }
    public function banner_update($banner_id){
        $update_banner=DB::table("tbl_banner")->where('banner_id',$banner_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_banner=view('admin_include.page.banner.update')->with('update_banner',$update_banner);
        return  view('admin')->with('admin_include.page.banner.update',$manager_banner);
    }
    public function post_banner_update(Request $request, $banner_id){
        $product=DB::table('tbl_banner')->where('banner_id',$banner_id)->first();
        $status=0;
        $data=[];
        if($product->banner_status==1){
            if($request->banner_status==""){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->banner_status == 0) {
            if($request->banner_status==""){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['banner_name']=$request->banner_name;
       $data['banner_status']=$status;
       
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data);
        Session::put('mess','Cập nhật danh mục sản phẩm thành công');
        return " <script> alert('Cập nhật thành công'); window.location = '".route('banner_list')."';</script>";
    }
    public function banner_delete($banner_id){
        DB::table('tbl_banner')->where('banner_id',$banner_id)->delete();
        Session::put('mess','Xóa danh mục sản phẩm thành công');
       // return redirect()->route('banner_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '".route('banner_list')."';</script>";
    }
}
