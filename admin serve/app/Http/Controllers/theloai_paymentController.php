<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;


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
       $category_payment_name = $request->input('category_payment_name');
        $category_payment_mota = html_entity_decode($request->input('category_payment_mota'));
    
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_category_payment hay chưa
       $category_paymentExists = DB::table('tbl_category_payment')
                           ->where('category_payment_name', $category_payment_name)
                           ->exists();
   
       if ($category_paymentExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_category_payment
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['category_payment_name']=$category_payment_name;
       $data['category_payment_note']= $category_payment_mota;
       $data['category_payment_status']= 0;
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
        $category_payment_name = $request->input('category_payment_name');
         $category_payment_mota = html_entity_decode($request->input('category_payment_mota'));
     
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_category_payment hay chưa
        $category_paymentExists = DB::table('tbl_category_payment')
                            ->where('category_payment_name', $category_payment_name)
                            ->where('category_payment_id', '<>', $category_payment_id)
                            ->exists();
    
        if ($category_paymentExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_category_payment
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['category_payment_name']=$category_payment_name;
        $data['category_payment_note']= $category_payment_mota;
        DB::table('tbl_category_payment')->where('category_payment_id',$category_payment_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '".route('category_payment_list')."';</script>";
    }
    public function togggle_status($category_payment_id, $category_payment_status){
        $product=DB::table('tbl_category_payment')->where('category_payment_id',$category_payment_id)->first();
        $status=0;
        $data=[];
        if($product->category_payment_status==1){
            if($category_payment_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->category_payment_status == 0) {
            if($category_payment_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['category_payment_status']=$status;
        DB::table('tbl_category_payment')->where('category_payment_id',$category_payment_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('category_payment_list')."';</script>";
    }
}
