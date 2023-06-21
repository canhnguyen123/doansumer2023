<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\YourModel;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\name_size_classRequest;
session_start();
class sizeProductController extends Controller
{
    public function size_list(){
        $list_size=DB::table("tbl_size")->get();
        $count=DB::table("tbl_size")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_size=view('admin_include.page.product.size.list')
        ->with('list_size',$list_size)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.product.size.list',$manager_size);
    }
    public function size_add(){
        return  view('admin_include.page.product.size.add');
    }
    public function post_size_add(Request $request){
       $data=[];
       $sizeName = $request->size_name;
       $sizedescribl_old = $request->size_describl;
        $sizedescribl_1 = html_entity_decode($sizedescribl_old);
        $sizedescribl = strip_tags($sizedescribl_1);
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_size hay chưa
       $sizeExists = DB::table('tbl_size')
                           ->where('name_size', $sizeName)
                           ->orWhere('describle_size', $sizedescribl)
                           ->exists();
   
       if ($sizeExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_size
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['name_size']=$sizeName;
       $data['describle_size']=$sizedescribl;
       $data['status_size']=0;
       $data['created_at'] = Carbon::now();
       DB::table('tbl_size')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('size_list')."';</script>";
     }
    public function size_update($id_size){
        $update_size=DB::table("tbl_size")->where('id_size',$id_size)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_size=view('admin_include.page.product.size.update')->with('update_size',$update_size);
        return  view('admin')->with('admin_include.page.product.size.update',$manager_size);
    }
    public function post_size_update(Request $request, $id_size){
       
        $data=[];
       
        $data['name_size']=$request->size_name;
        $data['describle_size']=$request->size_describl;
  
      
       
       $up= DB::table('tbl_size')->where('id_size',$id_size)->update($data);
        if($up){
            return " <script> alert('Sửa thành công'); window.location = '".route('size_list')."';</script>";
        }else{
            return " <script> alert('Sửa thất bại'); window.location = '".route('size_update')."';</script>";

        }

    }
    public function togggle_status($id_size, $status_size){
        $product=DB::table('tbl_size')->where('id_size',$id_size)->first();
        $status=0;
        $data=[];
        if($product->status_size==1){
            if($status_size==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->status_size== 0) {
            if($status_size==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['status_size']=$status;
        DB::table('tbl_size')->where('id_size',$id_size)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('size_list')."';</script>";
    }
}
