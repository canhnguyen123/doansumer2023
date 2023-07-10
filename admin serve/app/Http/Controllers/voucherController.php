<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

session_start();

class voucherController extends Controller
{
    public function voucher_list(){
        $list_voucher=DB::table("tbl_vocher")->get();
        $count=DB::table("tbl_vocher")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_voucher=view('admin_include.page.voucher.list')
        ->with('list_voucher',$list_voucher)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.voucher.list',$manager_voucher);
    }
    public function voucher_add(){
        return  view('admin_include.page.voucher.add');
    }
    public function post_voucher_add(Request $request){
       $data=[];
       $voucher_name = $request->input('voucher_name');
       $voucher_code = $request->input('voucher_code');
       $voucher_down = $request->input('voucher_down');
       $voucher_startDate = $request->input('voucher_startDate');
       $voucher_endDate = $request->input('voucher_endDate');
       $mota_voucher = html_entity_decode($request->input('mota_voucher'));
    
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_vocher hay chưa
       $voucherExists = DB::table('tbl_vocher')
                           ->where('voucher_code', $voucher_code)
                           ->exists();
   
       if ($voucherExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_vocher
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['voucher_code']=$voucher_code;
       $data['voucher_name']= $voucher_name;
       $data['voucher_name']=$voucher_name;
       $data['voucher_context']= $mota_voucher;
       $data['voucher_down']=$voucher_down;
       $data['voucher_start']= $voucher_startDate;
       $data['voucher_end']= $voucher_endDate;
       $data['voucher_status']= 0;
       $data['created_at']= Carbon::now();
       DB::table('tbl_vocher')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('voucher_list')."';</script>";
     }
    public function voucher_update($voucher_id){
        $update_voucher=DB::table("tbl_vocher")->where('voucher_id',$voucher_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_voucher=view('admin_include.page.voucher.update')->with('update_voucher',$update_voucher);
        return  view('admin')->with('admin_include.page.voucher.update',$manager_voucher);
    }
    public function post_voucher_update(Request $request, $voucher_id){
        $data=[];
        $voucher_name = $request->input('voucher_name');
        $voucher_code = $request->input('voucher_code');
        $voucher_down = $request->input('voucher_down');
        $voucher_startDate = $request->input('voucher_startDate');
        $voucher_endDate = $request->input('voucher_endDate');
        $mota_voucher = html_entity_decode($request->input('mota_voucher'));
     
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_vocher hay chưa
        $voucherExists = DB::table('tbl_vocher')
                            ->where('voucher_code', $voucher_code)
                            ->where('voucher_id', '<>', $voucher_id)
                            ->exists();
    
        if ($voucherExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_vocher
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['voucher_code']=$voucher_code;
        $data['voucher_name']= $voucher_name;
        $data['voucher_name']=$voucher_name;
        $data['voucher_context']= $mota_voucher;
        $data['voucher_down']=$voucher_down;
        $data['voucher_start']= $voucher_startDate;
        $data['voucher_end']= $voucher_endDate;
        DB::table('tbl_vocher')->where('voucher_id',$voucher_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('voucher_list')."';</script>";
    }
    public function togggle_status($voucher_id, $voucher_status){
        $product=DB::table('tbl_vocher')->where('voucher_id',$voucher_id)->first();
        $status=0;
        $data=[];
        if($product->voucher_status==1){
            if($voucher_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->voucher_status == 0) {
            if($voucher_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['voucher_status']=$status;
        DB::table('tbl_vocher')->where('voucher_id',$voucher_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('voucher_list')."';</script>";
    }
}
