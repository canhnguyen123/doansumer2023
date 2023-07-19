<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\validateRequet;
session_start();

class statusController extends Controller
{
    public function status_list(){
        $list_status=DB::table("tbl_status_product")->get();
        $count=DB::table("tbl_status_product")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_status=view('admin_include.page.product.status.list')
        ->with('list_status',$list_status)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.product.status.list',$manager_status);
    }
    public function status_add(){
        return  view('admin_include.page.product.status.add');
    }
    public function post_status_add(validateRequet $request){
       $data=[];
       $statusName = $request->status_name;
       $statusCode = $request->status_code;
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_status_product hay chưa
       $statusExists = DB::table('tbl_status_product')
                           ->where('status_name', $statusName)
                           ->orWhere('status_code', $statusCode)
                           ->exists();
   
       if ($statusExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_status_product
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['status_name']=$request->status_name;
       $data['status_code']=$request->status_code;
       $data['created_at'] = Carbon::now();
       DB::table('tbl_status_product')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('status_list')."';</script>";
     }
    public function status_update($status_id){
        $update_status=DB::table("tbl_status_product")->where('status_id',$status_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_status=view('admin_include.page.product.status.update')->with('update_status',$update_status);
        return  view('admin')->with('admin_include.page.product.status.update',$manager_status);
    }
    public function post_status_update(validateRequet $request, $status_id){
        $data=[];
                 // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_status_product hay chưa
         $statusExists = DB::table('tbl_status_product')
       ->where('status_name', $request->status_name)
       ->Where('status_id', "<>",$status_id)
       ->exists();

        if ($statusExists) {
        // Dữ liệu đã tồn tại trong bảng tbl_status_product
        $errorMessage = "Dữ liệu đã tồn tại!";
        session()->flash('errorMessage', $errorMessage);
        return redirect()->back();
        }
        $data['status_name']=$request->status_name;
        DB::table('tbl_status_product')->where('status_id',$status_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('status_list')."';</script>";
    }
    public function status_delete($status_id){
        DB::table('tbl_status_product')->where('status_id',$status_id)->delete();
        Session::put('mess','Xóa danh mục sản phẩm thành công');
       // return redirect()->route('status_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '".route('status_list')."';</script>";
    }
}
