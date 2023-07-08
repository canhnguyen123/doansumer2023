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
        $list_category= DB::table('tbl_category')->where('category_status',1)->get();
        $list_phanloai= DB::table('tbl_phanloai')->where('phanloai_status',1)->get();
        $list_theloai = DB::table('tbl_theloai')
        ->join('tbl_category', 'tbl_theloai.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_phanloai', 'tbl_theloai.phanloai_id', '=', 'tbl_phanloai.phanloai_id')
        ->select('tbl_theloai.*', 'tbl_category.category_name', 'tbl_phanloai.phanloai_name')
        ->paginate(10);
        $count=DB::table("tbl_theloai")->count();
    
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_theloai=view('admin_include.page.product.theloai.list')
        ->with('list_theloai',$list_theloai)
        ->with('list_category',$list_category)
        ->with('list_phanloai',$list_phanloai)
        ->with('count',$count);
        return  view('admin')->with('admin_include.page.product.theloai.list',$manager_theloai);
    }

    public function theloai_add(){
        $list_theloai=DB::table("tbl_theloai")->orderBy("theloai_id","asc")->where("theloai_status",1)->get();
        $list_phanloai=DB::table("tbl_phanloai")->orderBy("phanloai_id","asc")->where("phanloai_status",1)->get();
        $list_category=DB::table("tbl_category")->orderBy("category_id","asc")->where("category_status",1)->get();
        return  view('admin_include.page.product.theloai.add')
        ->with('list_theloai',$list_theloai)
        ->with('list_phanloai',$list_phanloai)
        ->with('list_category',$list_category);
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
        $data['show_home']=0;
        

        $inserted = DB::table('tbl_theloai')->insert($data);
        if ($inserted) {
            return response()->json(['success' => true, 'message' => 'Thêm thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
        }
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
        $data=[];
        $data['category_id']=$request->category_code;
        $data['phanloai_id']=$request->phanloai_code;
        $data['theloai_name']=$request->theloai_name;
        $data['theloai_link_img']=$request->imageURL;
         $update=   DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->update($data);
        return response()->json(['success' => true, 'message' => "Sửa thành công"]);

        // if ($update) {
          
        // //    return response()->json(['success' => true, 'message' => $request->theloai_status]);
        //    return response()->json(['success' => true, 'message' => "Sửa thành công"]);
        // } else {
        //     return response()->json(['success' => false, 'message' => 'Sửa không thành công']);
        //  }

    } 
    public function togggle_status($theloai_id, $theloai_status){
        $product=DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->first();
        $status=0;
        $data=[];
        if($product->theloai_status==1){
            if($theloai_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->theloai_status == 0) {
            if($theloai_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['theloai_status']=$status;
        DB::table('tbl_theloai')->where('theloai_id',$theloai_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('theloai_list')."';</script>";
    }
}
