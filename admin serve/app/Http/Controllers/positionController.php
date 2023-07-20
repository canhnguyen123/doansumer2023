<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validateRequet;
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
        $list_phanquyen=DB::table("tbl_phanquyen")->where('phanquyen_status',1)->get();
        return  view('admin_include.page.staff.position.add')
        ->with('list_phanquyen',$list_phanquyen);
    }
    public function post_position_add(validateRequet $request){
       $data=[];
       $positionName = $request->position_name;
        $listQuyen= $request->listQuyen;
   
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
       $data['chucvu_status']=1;
       DB::table('tbl_chucvu')->insert($data);
       $insertedId = DB::getPdo()->lastInsertId();
       foreach($listQuyen as $item){
        $data1['phanquyen_id']=$item;
        $data1['chucvu_id']= $insertedId;
        $data1['group_status']= 1;
        DB::table('tbl_groupquyen_prosition')->insert($data1);
       }
       return " <script> alert('Thêm thành công'); window.location = '".route('position_list')."';</script>";
     }
     public function position_update($position_id){
        $list_chucvu=DB::table("tbl_chucvu")->where('chucvu_id',$position_id)->get();
        $list_phanquyen=DB::table("tbl_phanquyen")->where('phanquyen_status',1)->get();
        $groupquyen_prosition = DB::table("tbl_groupquyen_prosition")
        ->join("tbl_phanquyen", "tbl_groupquyen_prosition.phanquyen_id", "=", "tbl_phanquyen.phanquyen_id")
        ->where('tbl_groupquyen_prosition.group_status', 1)
        ->where('tbl_groupquyen_prosition.chucvu_id', $position_id)
        ->get(['tbl_groupquyen_prosition.*', 'tbl_phanquyen.phanquyen_nameGroup']);
        return  view('admin_include.page.staff.position.update')
        ->with('list_chucvu',$list_chucvu)
        ->with('list_phanquyen',$list_phanquyen)
        ->with('groupquyen_prosition',$groupquyen_prosition);
    }
    public function post_position_update(validateRequet $request, $position_id)
    {
        $data = [];
        $positionName = $request->position_name;
        $listQuyen = $request->listQuyen;
    
        // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_chucvu hay chưa
        $positionExists = DB::table('tbl_chucvu')
                            ->where('chucvu_name', $positionName)
                            ->where('chucvu_id', '<>', $position_id)
                            ->exists();
    
        if ($positionExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_chucvu
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
    
        $data['chucvu_name'] = $positionName;
        DB::table('tbl_chucvu')->where('chucvu_id', $position_id)->update($data);
    
        // Lấy danh sách các phanquyen_id hiện có từ bảng tbl_groupquyen_prosition
        $existingPhanQuyenIds = DB::table('tbl_groupquyen_prosition')
                                ->where('chucvu_id', $position_id)
                                ->pluck('phanquyen_id')
                                ->toArray();
    
        // Cập nhật trạng thái và thêm mới các hàng trong bảng tbl_groupquyen_prosition
        if($listQuyen){
            foreach ($listQuyen as $phanquyenId) {
                if (in_array($phanquyenId, $existingPhanQuyenIds)) {
                    // Cập nhật trạng thái thành 1
                    DB::table('tbl_groupquyen_prosition')
                        ->where('chucvu_id', $position_id)
                        ->where('phanquyen_id', $phanquyenId)
                        ->update(['group_status' => 1]);
                } else {
                    // Thêm mới hàng nếu chưa tồn tại
                    DB::table('tbl_groupquyen_prosition')->insert([
                        'chucvu_id' => $position_id,
                        'phanquyen_id' => $phanquyenId,
                        'group_status' => 1
                    ]);
                }
            }
        
            // Cập nhật trạng thái của các hàng còn lại thành 0
            DB::table('tbl_groupquyen_prosition')
                ->where('chucvu_id', $position_id)
                ->whereNotIn('phanquyen_id', $listQuyen)
                ->update(['group_status' => 0]);
        
        }
       
        return "<script> alert('Cập nhật thành công'); window.location = '".route('position_list')."';</script>";
    }
    
    public function position_deatil($position_id){
        $list_chucvu=DB::table("tbl_chucvu")->where('chucvu_id',$position_id)->get();
        $groupquyen_prosition = DB::table("tbl_groupquyen_prosition")
        ->join("tbl_phanquyen", "tbl_groupquyen_prosition.phanquyen_id", "=", "tbl_phanquyen.phanquyen_id")
        ->where('tbl_groupquyen_prosition.group_status', 1)
        ->where('tbl_groupquyen_prosition.chucvu_id', $position_id)
        ->get(['tbl_groupquyen_prosition.*', 'tbl_phanquyen.phanquyen_nameGroup']);
        return  view('admin_include.page.staff.position.deatil')
        ->with('list_chucvu',$list_chucvu)
        ->with('groupquyen_prosition',$groupquyen_prosition);
    }

    public function togggle_status($position_id, $chucvu_status){
        $product=DB::table('tbl_chucvu')->where('chucvu_id',$position_id)->first();
        $status=0;
        $data=[];
        if($product->chucvu_status==1){
            if($chucvu_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->chucvu_status== 0) {
            if($chucvu_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['chucvu_status']=$status;
        DB::table('tbl_chucvu')->where('chucvu_id',$position_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('position_list')."';</script>";
    }
}
