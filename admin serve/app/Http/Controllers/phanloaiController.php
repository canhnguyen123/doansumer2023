<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\validateRequet;
session_start();
class phanloaiController extends Controller
{
    public function phanloai_list(){
        $check=0;
        $list_phanloai=DB::table("tbl_phanloai")->paginate(5);
        $count=DB::table("tbl_phanloai")->count();
        $hasMoreData = $list_phanloai->hasMorePages();
        if($hasMoreData){
            $check=1;
        }else{
            $check=0;
        }
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanloai=view('admin_include.page.product.phanloai.list')
        ->with('list_phanloai',$list_phanloai)
        ->with('count',$count)
        ->with('check',$check);
        return  view('admin')->with('admin_include.page.product.phanloai.list',$manager_phanloai);
    }
    public function phanloai_add(){
        return  view('admin_include.page.product.phanloai.add');
    }
    public function post_phanloai_add(validateRequet $request){
        $data=[];
        $phanloai_name = $request->phanloai_name;
        $phanloai_code = $request->phanloai_code;   
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanloai hay chưa
        $phanloaiExists = DB::table('tbl_phanloai')
                            ->where('phanloai_name', $phanloai_name)
                            ->orWhere('phanloai_code', $phanloai_code)
                            ->exists();
    
        if ($phanloaiExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanloai
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanloai_name']=$phanloai_name;
        $data['phanloai_code']=$phanloai_code;
        $data['phanloai_status']=0;

        DB::table('tbl_phanloai')->insert($data);
        return " <script> alert('Thêm thành công'); window.location = '".route('phanloai_list')."';</script>";
      }
      public function phanloai_update($phanloai_id){
        $update_phanloai=DB::table("tbl_phanloai")->where('phanloai_id',$phanloai_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanloai=view('admin_include.page.product.phanloai.update')->with('update_phanloai',$update_phanloai);
        return  view('admin')->with('admin_include.page.product.phanloai.update',$manager_phanloai);
    }
    public function post_phanloai_update(validateRequet $request, $phanloai_id){
       
        $data=[];
        $phanloaiExists = DB::table('tbl_phanloai')
        ->where('phanloai_name', $request->phanloai_name)
        ->where('phanloai_id','<>', $phanloai_id)
       ->exists();

        if ($phanloaiExists) {
        // Dữ liệu đã tồn tại trong bảng tbl_phanloai
        $errorMessage = "Dữ liệu đã tồn tại!";
        session()->flash('errorMessage', $errorMessage);
        return redirect()->back();
        }
        $data['phanloai_name']=$request->phanloai_name;
   
       
        DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->update($data);
        
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanloai_list')."';</script>";
    }
    public function togggle_status($phanloai_id, $phanloai_status){
        $product=DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->first();
        $status=0;
        $data=[];
        if($product->phanloai_status==1){
            if($phanloai_status==0){
                $status=1;
            }else{  
                $status=0;
            }
        }
         if ($product->phanloai_status == 0) {
            if($phanloai_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['phanloai_status']=$status;
        DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanloai_list')."';</script>";
    }
}
