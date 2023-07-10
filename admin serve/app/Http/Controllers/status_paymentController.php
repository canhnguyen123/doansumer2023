<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class status_paymentController extends Controller
{
    public function status_payment_list(){
        $list_status_payment=DB::table("tbl_status_payment")->get();
        $count=DB::table("tbl_status_payment")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_status_payment=view('admin_include.page.payment.status_payment.list')
        ->with('list_status_payment',$list_status_payment)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.payment.status_payment.list',$manager_status_payment);
    }
    public function status_payment_add(){
        return  view('admin_include.page.payment.status_payment.add');
    }
    public function post_status_payment_add(Request $request){
       $data=[];
       $status_hoadon_name = $request->input('status_hoadon_name');
        $status_hoadon_mota = html_entity_decode($request->input('status_hoadon_mota'));
    
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_status_payment hay chưa
       $status_paymentExists = DB::table('tbl_status_payment')
                           ->where('status_payment_name', $status_hoadon_name)
                           ->exists();
   
       if ($status_paymentExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_status_payment
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['status_payment_name']=$status_hoadon_name;
       $data['status_payment_note']= $status_hoadon_mota;
       $data['created_at']= Carbon::now();
       DB::table('tbl_status_payment')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('status_payment_list')."';</script>";
     }
    public function status_payment_update($status_payment_id){
        $update_status_payment=DB::table("tbl_status_payment")->where('status_payment_id',$status_payment_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_status_payment=view('admin_include.page.payment.status_payment.update')->with('update_status_payment',$update_status_payment);
        return  view('admin')->with('admin_include.page.payment.status_payment.update',$manager_status_payment);
    }
    public function post_status_payment_update(Request $request, $status_payment_id){
        $data=[];
        $status_hoadon_name = $request->input('status_hoadon_name');
         $status_hoadon_mota = html_entity_decode($request->input('status_hoadon_mota'));
     
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_status_payment hay chưa
        $status_paymentExists = DB::table('tbl_status_payment')
                            ->where('status_payment_name', $status_hoadon_name)
                            ->where('status_payment_id', '<>', $status_payment_id)
                            ->exists();
    
        if ($status_paymentExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_status_payment
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['status_payment_name']=$status_hoadon_name;
        $data['status_payment_note']= $status_hoadon_mota;
        DB::table('tbl_status_payment')->where('status_payment_id',$status_payment_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('status_payment_list')."';</script>";
    }

}
