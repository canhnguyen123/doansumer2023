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

class brandController extends Controller
{
    public function brand_list(){
        $list_brand=DB::table("tbl_brand")->get();
        $count=DB::table("tbl_brand")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_brand=view('admin_include.page.product.brand.list')
        ->with('list_brand',$list_brand)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.product.brand.list',$manager_brand);
    }
    public function brand_add(){
        return  view('admin_include.page.product.brand.add');
    }
    public function post_brand_add(Request $request){
       $data=[];
       $brandName = $request->brand_name;
       $brandCode = $request->brand_code;
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_brand hay chưa
       $brandExists = DB::table('tbl_brand')
                           ->where('brand_name', $brandName)
                           ->orWhere('brand_code', $brandCode)
                           ->exists();
   
       if ($brandExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_brand
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['brand_name']=$brandName;
       $data['brand_code']= $brandCode;
       $data['brand_status']= 0;
       $data['created_at']= Carbon::now();
       DB::table('tbl_brand')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('brand_list')."';</script>";
     }
    public function brand_update($brand_id){
        $update_brand=DB::table("tbl_brand")->where('brand_id',$brand_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_brand=view('admin_include.page.product.brand.update')->with('update_brand',$update_brand);
        return  view('admin')->with('admin_include.page.product.brand.update',$manager_brand);
    }
    public function post_brand_update(Request $request, $brand_id){
        $product=DB::table('tbl_brand')->where('brand_id',$brand_id)->first();
        $status=0;
        $data=[];
        if($product->brand_status==1){
            if($request->brand_status==""){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->brand_status == 0) {
            if($request->brand_status==""){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['brand_name']=$request->brand_name;
        $data['brand_status']=$status;
       
        DB::table('tbl_brand')->where('brand_id',$brand_id)->update($data);
     
        return " <script> alert('Cập nhật thành công'); window.location = '".route('brand_list')."';</script>";
    }
    public function brand_delete($brand_id){
        DB::table('tbl_brand')->where('brand_id',$brand_id)->delete();
        Session::put('mess','Xóa danh mục sản phẩm thành công');
       // return redirect()->route('brand_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '".route('brand_list')."';</script>";
    }
}
