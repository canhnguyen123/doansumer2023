<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\validateRequet;
session_start();

class colorController extends Controller
{
    public function color_list(){
        $check=0;
        $list_color=DB::table("tbl_color")->paginate(5);
        $count=DB::table("tbl_color")->count();
        $hasMoreData = $list_color->hasMorePages();
        if($hasMoreData){
            $check=1;
        }else{
            $check=0;
        }
        $manager_color=view('admin_include.page.product.color.list')
        ->with('list_color',$list_color)
        ->with('count',$count) ->with('check',$check) ;
        return  view('admin')->with('admin_include.page.product.color.list',$manager_color);
    }
    public function color_add(){
        return  view('admin_include.page.product.color.add');
    }
    public function post_color_add(validateRequet $request){
       $data=[];
       $colorName = $request->color_name;
       $colorCode = $request->color_code;
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_color hay chưa
       $colorExists = DB::table('tbl_color')
                           ->where('color_name', $colorName)
                           ->orWhere('color_code', $colorCode)
                           ->exists();
   
       if ($colorExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_color
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
       $data['color_name']=$colorName;
       $data['color_code']= $colorCode;
       $data['color_status']= 0;
       DB::table('tbl_color')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('color_list')."';</script>";
     }
    public function color_update($color_id){
        $update_color=DB::table("tbl_color")->where('color_id',$color_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_color=view('admin_include.page.product.color.update')->with('update_color',$update_color);
        return  view('admin')->with('admin_include.page.product.color.update',$manager_color);
    }
    public function post_color_update(validateRequet $request, $color_id){
      
        $data=[];
        $colorExists = DB::table('tbl_color')
        ->where('color_name', $request->color_name)
        ->where('color_code',$request->color_code)
        ->Where('color_id', '<>',$color_id)
        ->exists();

        if ($colorExists) {
        // Dữ liệu đã tồn tại trong bảng tbl_color
        $errorMessage = "Dữ liệu đã tồn tại!";
        session()->flash('errorMessage', $errorMessage);
        return redirect()->back();
        }
        $data['color_name']=$request->color_name;
        $data['color_code']=$request->color_code;
       
       
        DB::table('tbl_color')->where('color_id',$color_id)->update($data);
        Session::put('mess','Cập nhật danh mục sản phẩm thành công');
        return " <script> alert('Cập nhật thành công'); window.location = '".route('color_list')."';</script>";
   }
   public function togggle_status($color_id, $color_status){
    $product=DB::table('tbl_color')->where('color_id',$color_id)->first();
    $status=0;
    $data=[];
    if($product->color_status==1){
        if($color_status==0){
            $status=1;
        }else{
            $status=0;
        }
    }
     if ($product->color_status == 0) {
        if($color_status==1){
            $status=0;
        }else{
            $status=1;
        }
    }
    $data['color_status']=$status;
    DB::table('tbl_color')->where('color_id',$color_id)->update($data); 
    return " <script> alert('Cập nhật thành công'); window.location = '".route('color_list')."';</script>";
}
}
