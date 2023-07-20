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
class phanquyenDeatilController extends Controller
{
    public function phanquyenDeatil_list(){
        $list_phanquyenDeatil = DB::table('tbl_phanquyen_deatil')
            ->join('tbl_phanquyen', 'tbl_phanquyen.phanquyen_id', '=', 'tbl_phanquyen_deatil.phanquyen_id')
            ->select('tbl_phanquyen_deatil.*', 'tbl_phanquyen.phanquyen_nameGroup')
            ->paginate(10);
      
        $count=DB::table("tbl_phanquyen_deatil")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_phanquyenDeatil=view('admin_include.page.staff.phanquyenDeatil.list')
        ->with('list_phanquyenDeatil',$list_phanquyenDeatil)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.staff.phanquyenDeatil.list',$manager_phanquyenDeatil);
    }
    public function phanquyenDeatil_add(){
        $list_phanquyen=DB::table("tbl_phanquyen")->get();
        return  view('admin_include.page.staff.phanquyenDeatil.add')
        ->with('list_phanquyen',$list_phanquyen);
    }
    public function post_phanquyenDeatil_add(validateRequet $request){
        $data=[];
        $phanquyen_id = $request->phanquyen_id;
        $phanquyenDeatil_name = $request->phanquyenDeatil_name;
        $phanquyenDeatil_route = $request->phanquyenDeatil_route;
        $phanquyenDeatil_mota =html_entity_decode($request->phanquyenDeatil_mota);   
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanquyen_deatil hay chưa
        $phanquyenDeatilExists = DB::table('tbl_phanquyen_deatil')
                            ->where('phanquyenDeatil_route', $phanquyenDeatil_name)
                            ->exists();
    
        if ($phanquyenDeatilExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanquyen_deatil
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanquyen_id']=$phanquyen_id;
        $data['phanquyenDeatil_name']=$phanquyenDeatil_name;
        $data['phanquyenDeatil_route']=$phanquyenDeatil_route;
        $data['phanquyenDeatil_note']=$phanquyenDeatil_mota;
        $data['phanquyenDeatil_status']=1;

     $insert=   DB::table('tbl_phanquyen_deatil')->insert($data);
        if($insert){
            return " <script> alert('Thêm thành công'); window.location = '".route('phanquyenDeatil_list')."';</script>";
        }else{
            return " <script> alert('Thêm thất bại'); window.location = '".route('phanquyenDeatil_add')."';</script>";
        }
      }
      public function phanquyenDeatil_update($phanquyenDeatil_id)
      {
          $update_phanquyenDeatil = DB::table('tbl_phanquyen_deatil')
              ->join('tbl_phanquyen', 'tbl_phanquyen.phanquyen_id', '=', 'tbl_phanquyen_deatil.phanquyen_id')
              ->select('tbl_phanquyen_deatil.*', 'tbl_phanquyen.phanquyen_nameGroup')
              ->where('tbl_phanquyen_deatil.phanquyenDeatil_Id', $phanquyenDeatil_id)
              ->get();
      
          $list_phanquyen = DB::table("tbl_phanquyen")->get();
          $manager_phanquyenDeatil = view('admin_include.page.staff.phanquyenDeatil.update')
              ->with('update_phanquyenDeatil', $update_phanquyenDeatil)
              ->with('list_phanquyen', $list_phanquyen);
          return view('admin')->with('admin_include.page.staff.phanquyenDeatil.update', $manager_phanquyenDeatil);
      }
      
    public function post_phanquyenDeatil_update(validateRequet $request, $phanquyenDeatil_id){
        $data=[];
        $phanquyen_id = $request->phanquyen_id;
        $phanquyenDeatil_name = $request->phanquyenDeatil_name;
        $phanquyenDeatil_route = $request->phanquyenDeatil_route;
        $phanquyenDeatil_mota =html_entity_decode($request->phanquyenDeatil_mota);   
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_phanquyen_deatil hay chưa
        $phanquyenDeatilExists = DB::table('tbl_phanquyen_deatil')
                            ->where('phanquyenDeatil_name', $phanquyenDeatil_name)
                            ->where('phanquyen_id', $phanquyen_id)
                            ->where('phanquyenDeatil_Id','<>', $phanquyenDeatil_id)
                            ->exists();
    
        if ($phanquyenDeatilExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_phanquyen_deatil
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['phanquyen_id']=$phanquyen_id;
        $data['phanquyenDeatil_name']=$phanquyenDeatil_name;
        $data['phanquyenDeatil_route']=$phanquyenDeatil_route;
        $data['phanquyenDeatil_note']=$phanquyenDeatil_mota;
         $update= DB::table('tbl_phanquyen_deatil')->where('phanquyenDeatil_Id', $phanquyenDeatil_id)->update($data);
         return " <script> alert('Cập nhật thành công'); window.location = '".route('phanquyenDeatil_list')."';</script>";

        //  if($update){
        //     return " <script> alert('Cập nhật thành công'); window.location = '".route('phanquyenDeatil_list')."';</script>";
        // }else{
        //     return " <script> alert('Cập nhật thất bại'); window.location = '".route('phanquyenDeatil_update',['phanquyenDeatil_id' => $phanquyenDeatil_id])."';</script>";
        // }
      }
     
    public function togggle_status_phanquyenDeatl($phanquyenDeatil_id, $phanquyenDeatil_status){
        $staff=DB::table('tbl_phanquyen_deatil')->where('phanquyenDeatil_id',$phanquyenDeatil_id)->first();
        $status=0;
        $data=[];
        if($staff->phanquyenDeatil_status==1){
            if($phanquyenDeatil_status==0){
                $status=1;
            }else{  
                $status=0;
            }
        }
         if ($staff->phanquyenDeatil_status == 0) {
            if($phanquyenDeatil_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['phanquyenDeatil_status']=$status;
        DB::table('tbl_phanquyen_deatil')->where('phanquyenDeatil_id',$phanquyenDeatil_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('phanquyenDeatil_list')."';</script>";
    }  





}
