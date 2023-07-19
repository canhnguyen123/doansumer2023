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

class phanquyenController extends Controller
{
    public function phanquyen_list(){
        $list_phanquyen=DB::table("tbl_phanquyen")->get();
        $count=DB::table("tbl_phanquyen")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanquyen=view('admin_include.page.staff.phanquyen.list')
        ->with('list_phanquyen',$list_phanquyen)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.staff.phanquyen.list',$manager_phanquyen);
    }
    public function phanquyen_add(){
        return  view('admin_include.page.staff.phanquyen.add');
    }
    public function post_phanquyen_add(validateRequet $request){
        $data=[];
        $phanquyen_name = $request->phanquyen_name;
        $phanquyen_mota =html_entity_decode($request->phanquyen_mota);   
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanquyen hay chưa
        $phanquyenExists = DB::table('tbl_phanquyen')
                            ->where('phanquyen_nameGroup', $phanquyen_name)
                            ->exists();
    
        if ($phanquyenExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanquyen
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanquyen_nameGroup']=$phanquyen_name;
        $data['phanquyen_note']=$phanquyen_mota;
        $data['phanquyen_status']=1;

        DB::table('tbl_phanquyen')->insert($data);
        return " <script> alert('Thêm thành công'); window.location = '".route('phanquyen_list')."';</script>";
      }
      public function phanquyen_update($phanquyen_id){
        $update_phanquyen=DB::table("tbl_phanquyen")->where('phanquyen_id',$phanquyen_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanquyen=view('admin_include.page.staff.phanquyen.update')->with('update_phanquyen',$update_phanquyen);
        return  view('admin')->with('admin_include.page.staff.phanquyen.update',$manager_phanquyen);
    }
    public function post_phanquyen_update(validateRequet $request, $phanquyen_id){
        $data=[];
        $phanquyen_name = $request->phanquyen_name;
        $phanquyen_mota =html_entity_decode($request->phanquyen_mota);   
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanquyen hay chưa
        $phanquyenExists = DB::table('tbl_phanquyen')
                            ->where('phanquyen_nameGroup', $phanquyen_name)
                            ->where('phanquyen_id','<>',$phanquyen_id)
                            ->exists();
    
        if ($phanquyenExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanquyen
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('phanquyen_name', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanquyen_nameGroup']=$phanquyen_name;
        $data['phanquyen_note']=$phanquyen_mota;

      $update=  DB::table('tbl_phanquyen')->where('phanquyen_id',$phanquyen_id)->update($data);
      if($update){
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanquyen_list')."';</script>";
      }else{
        return " <script> alert('Cập nhật thất bại'); window.location = '".route('phanquyen_update',['phanquyen_id'=>$phanquyen_id])."';</script>";
        }
     }
    public function togggle_status_phannuyen($phanquyen_id, $phanquyen_status){
        $staff=DB::table('tbl_phanquyen')->where('phanquyen_id',$phanquyen_id)->first();
        $status=0;
        $data=[];
        if($staff->phanquyen_status==1){
            if($phanquyen_status==0){
                $status=1;
            }else{  
                $status=0;
            }
        }
         if ($staff->phanquyen_status == 0) {
            if($phanquyen_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['phanquyen_status']=$status;
        DB::table('tbl_phanquyen')->where('phanquyen_id',$phanquyen_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanquyen_list')."';</script>";
    }
}
