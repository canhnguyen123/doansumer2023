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
class theloai_paymentController extends Controller
{
    public function category_payment_list(){
        $list_category_payment=DB::table("tbl_category_payment")->get();
        $count=DB::table("tbl_category_payment")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_category_payment=view('admin_include.page.payment.theloai_payment.list')
        ->with('list_category_payment',$list_category_payment)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.payment.theloai_payment.list',$manager_category_payment);
    }
    public function category_payment_add(){
        return  view('admin_include.page.payment.theloai_payment.add');
    }
    public function post_category_payment_add(Request $request){
       $data=[];
       $status_hoadon_name = $request->input('status_hoadon_name');
        $status_hoadon_mota = html_entity_decode($request->input('status_hoadon_mota'));
    
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_category_payment hay chưa
       $category_paymentExists = DB::table('tbl_category_payment')
                           ->where('category_payment_name', $status_hoadon_name)
                           ->exists();
   
       if ($category_paymentExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_category_payment
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['category_payment_name']=$status_hoadon_name;
       $data['category_payment_note']= $status_hoadon_mota;
       $data['created_at']= Carbon::now();
       DB::table('tbl_category_payment')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('category_payment_list')."';</script>";
     }
    public function category_payment_update($category_payment_id){
        $update_category_payment=DB::table("tbl_category_payment")->where('category_payment_id',$category_payment_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_category_payment=view('admin_include.page.payment.theloai_payment.update')->with('update_category_payment',$update_category_payment);
        return  view('admin')->with('admin_include.page.payment.theloai_payment.update',$manager_category_payment);
    }
    public function post_category_payment_update(Request $request, $category_payment_id){
        $data=[];
        $status_hoadon_name = $request->input('status_hoadon_name');
         $status_hoadon_mota = html_entity_decode($request->input('status_hoadon_mota'));
     
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_category_payment hay chưa
        $category_paymentExists = DB::table('tbl_category_payment')
                            ->where('category_payment_name', $status_hoadon_name)
                            ->where('category_payment_id', '<>', $category_payment_id)
                            ->exists();
    
        if ($category_paymentExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_category_payment
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['category_payment_name']=$status_hoadon_name;
        $data['category_payment_note']= $status_hoadon_mota;
        $data['created_at']= Carbon::now();
        DB::table('tbl_category_payment')->where('category_payment_id',$category_payment_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('category_payment_list')."';</script>";
    }

}
