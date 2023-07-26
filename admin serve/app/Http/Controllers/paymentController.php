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
    public function payment_deatil($hoadon_id){
        $hoadon_detail = DB::table("tbl_hoadon")
            ->join("tbl_users", "tbl_hoadon.user_id", "=", "tbl_users.user_id")
            ->join("tbl_vocher", "tbl_hoadon.vocher_id", "=", "tbl_vocher.voucher_id")
            ->join("tbl_category_payment", "tbl_hoadon.category_payment_id", "=", "tbl_category_payment.category_payment_id")
            ->where('tbl_hoadon.hoadon_id', $hoadon_id)
            ->get(['tbl_hoadon.*', 'tbl_users.*', 'tbl_vocher.*','tbl_category_payment.*']);
            $hoadon_detail_item = DB::table("tbl_hoadon_deatil")
            ->join("tbl_product","tbl_hoadon_deatil.product_id","=","tbl_product.product_id")
            ->where('tbl_hoadon_deatil.hoadon_id', $hoadon_id)
            ->get(['tbl_product.*', 'tbl_hoadon_deatil.*']);
        $manager_payment = view('admin_include.page.payment.payment.deatil')
            ->with('hoadon_deatil', $hoadon_detail)
            ->with('hoadon_detail_item', $hoadon_detail_item);
        return $manager_payment;
    }
    public function post_bill_add(Request $request,$hoadon_id){
        $data=[];
        $payment_status = $request->payment_status;
        $payment_code = $request->payment_code;
        if($payment_status==2){
        $paymentExists = DB::table('tbl_hoadon')
                            ->where('hoadon_code', $payment_code)
                            ->exists();
    
        if ($paymentExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_hoadon
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
        $data['status_payment_id']=$payment_status;
        $data['hoadon_code']=$payment_code;
        DB::table('tbl_hoadon')->where('hoadon_id',$hoadon_id)->update($data);
        return " <script> alert('Đã tạo hóa đơn'); window.location = '".route('payment_list')."';</script>";
        }
        else if($payment_status==3){
            $data['status_payment_id']=$payment_status;
            DB::table('tbl_hoadon')->where('hoadon_id',$hoadon_id)->update($data);
            return " <script> alert('Cập nhật thành công'); window.location = '".route('payment_list')."';</script>";
        }
        else if($payment_status==4){
            $data['status_payment_id']=$payment_status;
            DB::table('tbl_hoadon')->where('hoadon_id',$hoadon_id)->update($data);
            return " <script> alert('Cập nhật thành công'); window.location = '".route('payment_list')."';</script>";
        }
        else if($payment_status==5){
            $data['status_payment_id']=$payment_status;
            DB::table('tbl_hoadon')->where('hoadon_id',$hoadon_id)->update($data);
            return " <script> alert('Đã hủy đơn thành công'); window.location = '".route('payment_list')."';</script>";
        }
       
 
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
