<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\YourModel;
use Illuminate\Support\Facades\File;


session_start();

class staffController extends Controller
{
    public function staff_list(){
        $list_staff=DB::table("tbl_staff")->get();

        $count=DB::table("tbl_staff")->count();
        $manager_staff=view('admin_include.page.staff.staff.list')
        ->with('list_staff',$list_staff)
       
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.staff.staff.list',$manager_staff);
    }
    public function staff_add(){
        $list_position=DB::table("tbl_chucvu")->get();
        return  view('admin_include.page.staff.staff.add') ->with('list_position',$list_position);
    }
    public function staff_deteal($staff_id){
        $staff_deatil = DB::table('tbl_staff')
        ->join('tbl_chucvu', 'tbl_staff.chucvu_id', '=', 'tbl_chucvu.chucvu_id')
        ->select('tbl_staff.*', 'tbl_chucvu.chucvu_name')
        ->where('tbl_staff.staff_id', $staff_id)
        ->get();
        return  view('admin_include.page.staff.staff.deatils') ->with('staff_deatil',$staff_deatil);
    }
    public function post_staff_add(Request $request){
       $data=[];
       $staff_code = $request->staff_code;
       $staff_name = $request->staff_name;
       $staff_password = $request->staff_password;
       $staff_fullname = $request->staff_fullname;
       $staff_phone = $request->staff_phone;
       $staff_email = $request->staff_email;
       $staff_postition = $request->staff_postition;
       $staff_img = $request->file('staff_img');
       $staff_address = $request->input('staff_address');
       $staff_address_deatil = $request->input('staff_address_deatil');
       $status_mota = html_entity_decode($request->input('status_mota'));
//       Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_staff hay chưa
       $staffExists = DB::table('tbl_staff')
                           ->where('staff_code', $staff_code)
                           ->orWhere('staff_username', $staff_name)
                           ->exists();
   
       if ($staffExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_staff
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['staff_code']=$staff_code;
       $data['staff_username']=$staff_name;
       $data['staff_password']=bcrypt($staff_password);
       $data['staff_fullname']=$staff_fullname;
       $data['staff_phone']=$staff_phone;
       $data['staff_email']=$staff_email;
       $data['staff_linkimg']=$staff_img->getClientOriginalName();
       $data['staff_address']=$staff_address." , ".$staff_address_deatil;
       $data['staff_note']=$status_mota;
       $data['staff_status']=1;
       $data['chucvu_id']=$staff_postition;
       $data['created_at'] = Carbon::now();
       $insert_staff= DB::table('tbl_staff')->insert($data);
       if($insert_staff){
        $uploadPath = public_path('upload');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }
        $upload = $staff_img->move(public_path('upload/BE'),$staff_img->getClientOriginalName());
        if($upload){
            return " <script> alert('Thêm thành công'); window.location = '".route('staff_list')."';</script>";
        }
       }    
       else{
        return " <script> alert('Thêm thất bại'); window.location = '".route('staff_add')."';</script>";
       }
     }
    public function staff_update($staff_id){
        $staff_update = DB::table('tbl_staff')
        ->join('tbl_chucvu', 'tbl_staff.chucvu_id', '=', 'tbl_chucvu.chucvu_id')
        ->select('tbl_staff.*', 'tbl_chucvu.chucvu_name')
        ->where('tbl_staff.staff_id', $staff_id)
        ->get();
        $list_position=DB::table("tbl_chucvu")->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_staff=view('admin_include.page.staff.staff.update')
        ->with('staff_update',$staff_update)
        ->with('list_position',$list_position);
        return  view('admin')->with('admin_include.page.staff.staff.update',$manager_staff);
    }
    public function post_staff_update(Request $request, $staff_id){
       
        $staff_deatil = DB::table('tbl_staff')
        ->where('staff_id', $staff_id)
        ->get();  
        $data=[];
        $check=true;
        $address="";
        $linkimg_name=" ";
       
        $staff_code = $request->staff_code;
        $staff_name = $request->staff_name;
        $staff_password = $request->staff_password;
        $staff_fullname = $request->staff_fullname;
        $staff_phone = $request->staff_phone;
        $staff_email = $request->staff_email;
        $staff_postition = $request->staff_postition;
        $staff_img = $request->file('staff_img');
        $status_mota = html_entity_decode($request->input('status_mota'));


        if($request->input('staff_address')==""|| $request->input('staff_address_deatil')==""){
            $address= $staff_deatil[0]->staff_address;
        }else{
            $address= $request->input('staff_address')." , ".$request->input('staff_address_deatil');
        }

        if ($staff_img && $staff_img->isValid()) {
            $linkimg_name = $staff_img->getClientOriginalName();
        } else {
            $linkimg_name = $staff_deatil[0]->staff_linkimg;
        }
 //       Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_staff hay chưa
            $staffExists = DB::table('tbl_staff')
            ->where(function ($query) use ($staff_code, $staff_id) {
                $query->where('staff_code', $staff_code)
                    ->where('staff_id', '<>', $staff_id);
            })
            ->exists();
    
        if ($staffExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_staff
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['staff_code']=$staff_code;
        $data['staff_name']=$staff_name;
        $data['staff_password']=bcrypt($staff_password);
        $data['staff_fullname']=$staff_fullname;
        $data['staff_phone']=$staff_phone;
        $data['staff_email']=$staff_email;
        $data['chucvu_id']=$staff_postition;
        $data['staff_linkimg']=$linkimg_name;
        $data['staff_address']= $address;
        $data['staff_note']=$status_mota;
        $data['staff_status']=1;
        $data['created_at'] = Carbon::now();
        $update_staff= DB::table('tbl_staff')->where('staff_id',$staff_id) ->update($data);
        if($update_staff){
         $uploadPath = public_path('upload');
         if ($staff_img && $staff_img->isValid()) {
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }
        $upload = $staff_img->move(public_path('upload/BE'),$staff_img->getClientOriginalName());
      
         }
            
             return " <script> alert('Cập nhật thành công'); window.location = '".route('staff_list')."';</script>";
         
        }    
        else{
         return " <script> alert('Cập  nhật thất bại'); window.location = '".route('staff_update',['id'=>$staff_id])."';</script>";
        }

    }
    public function togggle_status($staff_id, $staff_status){
        $product=DB::table('tbl_staff')->where('staff_id',$staff_id)->first();
        $status=0;
        $data=[];
        if($product->staff_status==1){
            if($staff_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->staff_status== 0) {
            if($staff_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['staff_status']=$status;
        DB::table('tbl_staff')->where('staff_id',$staff_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('staff_list')."';</script>";
    }
}
