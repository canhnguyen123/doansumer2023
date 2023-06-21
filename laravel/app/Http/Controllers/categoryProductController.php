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
class categoryProductController extends Controller
{
    public function category_list(){
        $list_category=DB::table("tbl_category")->get();
        $count=DB::table("tbl_category")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_category=view('admin_include.page.product.category.list')
        ->with('list_category',$list_category)
        ->with('count',$count) ;
        return  view('admin')->with('admin_include.page.product.category.list',$manager_category);
    }
    public function category_add(){
        return  view('admin_include.page.product.category.add');
    }
    public function post_category_add(Product_classRequest $request){
       $data=[];
       $categoryName = $request->category_name;
       $categoryCode = $request->category_code;
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_category hay chưa
       $categoryExists = DB::table('tbl_category')
                           ->where('category_name', $categoryName)
                           ->orWhere('category_code', $categoryCode)
                           ->exists();
   
       if ($categoryExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_category
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['category_name']=$request->category_name;
       $data['category_code']=$request->category_code;
       $data['category_status']=0;
       DB::table('tbl_category')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('category_list')."';</script>";
     }
    public function category_update($category_id){
        $update_category=DB::table("tbl_category")->where('category_id',$category_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_category=view('admin_include.page.product.category.update')->with('update_category',$update_category);
        return  view('admin')->with('admin_include.page.product.category.update',$manager_category);
    }
    public function post_category_update(Request $request, $category_id){
       
        $data['category_name']=$request->category_name;
      
        DB::table('tbl_category')->where('category_id',$category_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('category_list')."';</script>";
    }
    public function togggle_status($category_id, $category_status){
        $product=DB::table('tbl_category')->where('category_id',$category_id)->first();
        $status=0;
        $data=[];
        if($product->category_status==1){
            if($category_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->category_status == 0) {
            if($category_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['category_status']=$status;
        DB::table('tbl_category')->where('category_id',$category_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('category_list')."';</script>";
    }
}
