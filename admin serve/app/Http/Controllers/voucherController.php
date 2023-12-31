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
        $list_category_payment=DB::table("tbl_category_payment")->where('category_payment_status',1)->get();
        return  view('admin_include.page.voucher.add') ->with('list_category_payment',$list_category_payment);
    }
    public function post_voucher_add(Request $request){
       $data=[];
       $voucher_name = $request->input('voucher_name');
       $voucher_code = $request->input('voucher_code');
       $voucher_down = $request->input('voucher_down');
       $voucher_startDate = $request->input('voucher_startDate');
       $voucher_endDate = $request->input('voucher_endDate');
       $mota_voucher = html_entity_decode($request->input('mota_voucher'));
       $voucher_type = $request->input('voucher_type');
       $voucher_unit = $request->input('voucher_unit');
       $voucher_quantity = $request->input('voucher_quantity');
       $voucher_category_payment = $request->input('voucher_category_payment');
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
       $data['voucher_context']= $mota_voucher;
       $data['voucher_down']=$voucher_down;
       $data['voucher_start']= $voucher_startDate;
       $data['voucher_end']= $voucher_endDate;
       $data['voucher_category']=$voucher_type;
       $data['voucher_unit']= $voucher_unit;
       $data['voucher_limit']= $voucher_quantity;
       $data['category_payment_id']=  $voucher_category_payment;
       $data['voucher_status']= 0;
       $data['created_at']= Carbon::now();
       DB::table('tbl_vocher')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('voucher_list')."';</script>";
     }
    public function voucher_update($voucher_id){
        $update_voucher = DB::table("tbl_vocher")
            ->join("tbl_category_payment", "tbl_vocher.category_payment_id", "=", "tbl_category_payment.category_payment_id")
            ->select('tbl_vocher.*', 'tbl_category_payment.category_payment_name')
            ->where('tbl_vocher.voucher_id', $voucher_id)
            ->get();
        $list_category_payment=DB::table("tbl_category_payment")->where('category_payment_status',1)->get();
        $manager_voucher=view('admin_include.page.voucher.update')
        ->with('update_voucher',$update_voucher)
        ->with('list_category_payment',$list_category_payment);
        return  view('admin')->with('admin_include.page.voucher.update',$manager_voucher);
    }
    public function voucher_deatil($voucher_id){
        $deatil_voucher = DB::table("tbl_vocher")
            ->join("tbl_category_payment", "tbl_vocher.category_payment_id", "=", "tbl_category_payment.category_payment_id")
            ->select('tbl_vocher.*', 'tbl_category_payment.category_payment_name')
            ->where('tbl_vocher.voucher_id', $voucher_id)
            ->get();
 
        $manager_voucher=view('admin_include.page.voucher.deatil')
        ->with('deatil_voucher',$deatil_voucher);
        return  view('admin')->with('admin_include.page.voucher.deatil',$manager_voucher);
    }
    public function post_voucher_update(Request $request, $voucher_id){
        $data=[];
       $voucher_name = $request->input('voucher_name');
       $voucher_code = $request->input('voucher_code');
       $voucher_down = $request->input('voucher_down');
       $voucher_startDate = $request->input('voucher_startDate');
       $voucher_endDate = $request->input('voucher_endDate');
       $mota_voucher = html_entity_decode($request->input('mota_voucher'));
       $voucher_type = $request->input('voucher_type');
       $voucher_unit = $request->input('voucher_unit');
       $voucher_quantity = $request->input('voucher_quantity');
       $voucher_category_payment = $request->input('voucher_category_payment');
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_vocher hay chưa
       $voucherExists = DB::table('tbl_vocher')
                           ->where('voucher_code', $voucher_code)
                           ->where('voucher_id','<>', $voucher_id)
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
       $data['voucher_context']= $mota_voucher;
       $data['voucher_down']=$voucher_down;
       $data['voucher_start']= $voucher_startDate;
       $data['voucher_end']= $voucher_endDate;
       $data['voucher_category']=$voucher_type;
       $data['voucher_unit']= $voucher_unit;
       $data['voucher_limit']= $voucher_quantity;
       $data['category_payment_id']=  $voucher_category_payment;
       DB::table('tbl_vocher')->where('voucher_id',$voucher_id)->update($data);
       return " <script> alert('Cập nhật thành công'); window.location = '".route('voucher_list')."';</script>";}
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
