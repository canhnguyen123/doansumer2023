<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class positionController extends Controller
{
    public function position_list(){
        $list_position=DB::table("tbl_chucvu")->get();
        $count_position = DB::table('tbl_chucvu')->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_position=view('admin_include.page.staff.position.list')
        ->with('list_position',$list_position)
        ->with('count_position',$count_position);
        return  view('admin')->with('admin_include.page.staff.position.list',$manager_position);
    }
    public function position_add(){
        return  view('admin_include.page.staff.position.add');
    }
    public function post_position_add(Request $request){
       $data=[];
       $positionName = $request->position_name;
     
   
       // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_chucvu hay chưa
       $positionExists = DB::table('tbl_chucvu')
                           ->where('chucvu_name', $positionName)
                            ->exists();
   
       if ($positionExists) {
           // Dữ liệu đã tồn tại trong bảng tbl_chucvu
           $errorMessage = "Dữ liệu đã tồn tại!";
           session()->flash('errorMessage', $errorMessage);
           return redirect()->back();
       }
   

   ///Thêm dl vào csdl
       $data['chucvu_name']=$positionName;
       DB::table('tbl_chucvu')->insert($data);
       return " <script> alert('Thêm thành công'); window.location = '".route('position_list')."';</script>";
     }
 
    public function position_delete($position_id){
        DB::table('tbl_chucvu')->where('chucvu_id',$position_id)->delete();
        Session::put('mess','Xóa danh mục sản phẩm thành công');
       // return redirect()->route('position_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '".route('position_list')."';</script>";
    }
}
