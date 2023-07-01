<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\payment_classRequest;
session_start();

class paymentController extends Controller
{
    public function payment_list(){
      
        $count=DB::table("tbl_hoadon")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_payment=view('admin_include.page.payment.payment.list')
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.payment.payment.list',$manager_payment);
    }
    public function payment_add(){
        return  view('admin_include.page.payment.payment.add');
    }
    public function post_payment_add(Request $request){
        $data=[];
        $payment_name = $request->payment_name;
        $payment_code = $request->payment_code;
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_hoadon hay chưa
        $paymentExists = DB::table('tbl_hoadon')
                            ->where('payment_name', $payment_name)
                            ->orWhere('payment_code', $payment_code)
                            ->exists();
    
        if ($paymentExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_hoadon
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
 
    ///Thêm dl vào csdl
        $data['payment_name']=$payment_name;
        $data['payment_code']=$payment_code;
        $data['payment_status']=0;
        $data['created_at'] = Carbon::now();
        DB::table('tbl_hoadon')->insert($data);
        return " <script> alert('Thêm thành công'); window.location = '".route('payment_list')."';</script>";
      }
      public function payment_update($payment_id){
        $update_payment=DB::table("tbl_hoadon")->where('payment_id',$payment_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_payment=view('admin_include.page.payment.payment.update')->with('update_payment',$update_payment);
        return  view('admin')->with('admin_include.page.payment.payment.update',$manager_payment);
    }
    public function post_payment_update(Request $request, $payment_id){
       
        $data=[];
      
        $data['payment_name']=$request->payment_name;
        
       
        DB::table('tbl_hoadon')->where('payment_id',$payment_id)->update($data);
        
        return " <script> alert('Cập nhật thành công'); window.location = '".route('payment_list')."';</script>";
    }
    public function togggle_status($payment_id, $payment_status){
        $product=DB::table('tbl_hoadon')->where('payment_id',$payment_id)->first();
        $status=0;
        $data=[];
        if($product->payment_status==1){
            if($payment_status==0){
                $status=1;
            }else{  
                $status=0;
            }
        }
         if ($product->payment_status == 0) {
            if($payment_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['payment_status']=$status;
        DB::table('tbl_hoadon')->where('payment_id',$payment_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('payment_list')."';</script>";
    }
}
