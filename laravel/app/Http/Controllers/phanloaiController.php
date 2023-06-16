<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\phanloai_classRequest;
session_start();
class phanloaiController extends Controller
{
    public function phanloai_list(){
        $list_phanloai=DB::table("tbl_phanloai")->get();
        $count=DB::table("tbl_phanloai")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanloai=view('admin_include.page.product.phanloai.list')
        ->with('list_phanloai',$list_phanloai)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.product.phanloai.list',$manager_phanloai);
    }
    public function phanloai_add(){
        return  view('admin_include.page.product.phanloai.add');
    }
    public function post_phanloai_add(phanloai_classRequest $request){
        $data=[];
        $phanloai_name = $request->phanloai_name;
        $phanloai_code = $request->phanloai_code;
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanloai hay chưa
        $categoryExists = DB::table('tbl_phanloai')
                            ->where('phanloai_name', $phanloai_name)
                            ->orWhere('phanloai_code', $phanloai_code)
                            ->exists();
    
        if ($categoryExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanloai
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanloai_name']=$phanloai_name;
        $data['phanloai_code']=$phanloai_code;
        $data['phanloai_status']=0;
        $data['created_at'] = Carbon::now();
        DB::table('tbl_phanloai')->insert($data);
        return " <script> alert('Thêm thành công'); window.location = '".route('phanloai_list')."';</script>";
      }
      public function phanloai_update($phanloai_id){
        $update_phanloai=DB::table("tbl_phanloai")->where('phanloai_id',$phanloai_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanloai=view('admin_include.page.product.phanloai.update')->with('update_phanloai',$update_phanloai);
        return  view('admin')->with('admin_include.page.product.phanloai.update',$manager_phanloai);
    }
    public function post_phanloai_update(Request $request, $phanloai_id){
        $phanloai=DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->first();
        $status=0;
        $data=[];
        if($phanloai->phanloai_status==1){
            if($request->phanloai_status==""){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($phanloai->phanloai_status == 0) {
            if($request->phanloai_status==""){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['phanloai_name']=$request->phanloai_name;
         $data['phanloai_status']=$status;
       
        DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->update($data);
        
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanloai_list')."';</script>";
    }
    public function phanloai_delete($phanloai_id){
        DB::table('tbl_phanloai')->where('phanloai_id',$phanloai_id)->delete();
        Session::put('mess','Xóa danh mục sản phẩm thành công');
       // return redirect()->route('phanloai_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '".route('phanloai_list')."';</script>";
    }
}
