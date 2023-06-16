<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();
class theloaiProductController extends Controller
{
    public function theloai_list(){
      
        $list_theloai = DB::table('tbl_theloai')
        ->join('tbl_category', 'tbl_theloai.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_phanloai', 'tbl_theloai.phanloai_id', '=', 'tbl_phanloai.phanloai_id')
        ->select('tbl_theloai.*', 'tbl_category.category_name', 'tbl_phanloai.phanloai_name')
        ->get();
        $count=DB::table("tbl_theloai")->count();
    
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_theloai=view('admin_include.page.product.theloai.list')
        ->with('list_theloai',$list_theloai)
        ->with('count',$count);
        // ->with('get_category_name',$get_category_name)
        // ->with('category_name',$category_name);
        return  view('admin')->with('admin_include.page.product.theloai.list',$manager_theloai);
    }

    public function theloai_add(){
        $list_category=DB::table("tbl_category")->orderBy("category_id","asc")->where("category_status",1)->get();
        $list_phanloai=DB::table("tbl_phanloai")->orderBy("phanloai_id","asc")->where("phanloai_status",1)->get();
        return  view('admin_include.page.product.theloai.add')->with('list_category',$list_category)->with('list_phanloai',$list_phanloai);
    }
    public function post_theloai_add(Request $request)
    {
        $theloai_name = $request->input('theloai_name');
        $category_code = $request->category_code;
        $phanloai_code = $request->phanloai_code;
        $theloai_img = $request->input('content');
         $data['category_id']=  $category_code;
        $data['phanloai_id']=$phanloai_code;
        $data['theloai_name']= $theloai_name;
        $data['theloai_link_img']= $theloai_img;
        $data['theloai_status']=0;
        $data['created_at']=Carbon::now();
        

        $inserted = DB::table('tbl_theloai')->insert($data);
        if ($inserted) {
            return response()->json(['success' => true, 'message' => 'Thêm thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
        }
        // return "<script> alert('Thêm thành công'); window.location = '" . route('theloai_list') . "';</script>";
    }
    public function theloai_update($theloai_id){
        $update_theloai=DB::table("tbl_theloai")->where('theloai_id',$theloai_id)->get();
        if($update_theloai->count()>0){
            $category_id=$update_theloai->first()->category_id;
            $getcategory=DB::table("tbl_category")->where('category_id',$category_id)->get();

            $phanloai_id=$update_theloai->first()->phanloai_id;
            $getphanloai=DB::table("tbl_phanloai")->where('phanloai_id',$phanloai_id)->get();
        }
        $list_category=DB::table("tbl_category")->orderBy("category_id","asc")->get();
        $list_phanloai=DB::table("tbl_phanloai")->orderBy("phanloai_id","asc")->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_theloai=view('admin_include.page.product.theloai.update')
        ->with('update_theloai',$update_theloai)
        ->with('list_category',$list_category)
        ->with('list_phanloai',$list_phanloai)
        ->with('getcategory',$getcategory)
        ->with('getphanloai',$getphanloai);
        
        return  view('admin')->with('admin_include.page.product.theloai.update',$manager_theloai);
    }
    public function post_theloai_update(Request $request, $theloai_id){
        $theloai_update=DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->first();
        $status=0;
        $data=[];
        if($theloai_update->theloai_status==1){
            if($request->theloai_status==""){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($theloai_update->theloai_status == 0) {
            if($request->theloai_status==""){
                $status=0;
            }else{
                $status=1;
            }
        }
        // if ($theloai_update->theloai_status == 1 && $request->theloai_status == "") {
        //     $status = 1;
        // } else if ($theloai_update->theloai_status == 0 && $request->theloai_status != "") {
        //     $status = 1;
        // } else {
        //     $status = 0;
        // }
        
        $data['category_id']=$request->category_code;
        $data['phanloai_id']=$request->phanloai_code;
        $data['theloai_name']=$request->theloai_name;
        $data['theloai_link_img']=$request->imageURL;
        $data['theloai_status']=$status;
       
        $update=   DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->update($data);
      
        if ($update) {
          
        //    return response()->json(['success' => true, 'message' => $request->theloai_status]);
           return response()->json(['success' => true, 'message' => "Sửa thành công"]);
        } else {
            return response()->json(['success' => false, 'message' => 'Sửa không thành công']);
          
        

        }
    //     Session::put('mess','Cập nhật danh mục sản phẩm thành công');
        // return " <script> alert(''); window.location = '".route('theloai_list')."';</script>";
    }
    public function theloai_delete($theloai_id){
        DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->delete();
        return " <script> alert('Xóa thành công'); window.location = '".route('theloai_list')."';</script>";
    }
}
