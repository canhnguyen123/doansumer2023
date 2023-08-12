<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


session_start();

class bannerController extends Controller
{
    public function banner_list()
    { $check=0;
        $list_banner = DB::table("tbl_banner")->paginate(5);
        $count = DB::table("tbl_banner")->count();
        $hasMoreData = $list_banner->hasMorePages();
        if($hasMoreData){
            $check=1;
        }else{
            $check=0;
        }        $manager_banner = view('admin_include.page.banner.list')
            ->with('list_banner', $list_banner)
            ->with('count', $count)->with('count',$count) ->with('check',$check) ;
        return  view('admin')->with('admin_include.page.banner.list', $manager_banner);
    }
    public function banner_add()
    {
        return  view('admin_include.page.banner.add');
    }
    public function post_banner_add(Request $request)
    {
        $data = [];
        $banner_img = $request->input("banner_img");
        $banner_mota = $request->input("banner_mota");
        $data['banner_link'] = $banner_img;
        $data['banner_note'] = $banner_mota;
        $data['banner_status'] = 0;
        $data['created_at'] = Carbon::now();
        $inserted =   DB::table('tbl_banner')->insert($data);

        if ($inserted) {
            return response()->json(['success' => true, 'message' => 'Thêm thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
        }
    }
    public function banner_update($banner_id)
    {
        $update_banner = DB::table("tbl_banner")->where('banner_id', $banner_id)->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_banner = view('admin_include.page.banner.update')->with('update_banner', $update_banner);
        return  view('admin')->with('admin_include.page.banner.update', $manager_banner);
    }
    public function post_banner_update(Request $request, $banner_id)
    {
       
       
        $data['banner_note'] = html_entity_decode($request->input('mota_banner'));

        DB::table('tbl_banner')->where('banner_id', $banner_id)->update($data);
        return " <script> alert('Cập nhật thành công'); window.location = '" . route('banner_list') . "';</script>";
    }
    public function banner_delete($banner_id)
    {
        DB::table('tbl_banner')->where('banner_id', $banner_id)->delete();
        Session::put('mess', 'Xóa danh mục sản phẩm thành công');
        // return redirect()->route('banner_list')->with('success', 'Sửa thành công!');
        return " <script> alert('Xóa thành công'); window.location = '" . route('banner_list') . "';</script>";
    }
    public function togggle_status($banner_id, $banner_status){
        $product=DB::table('tbl_banner')->where('banner_id',$banner_id)->first();
        $status=0;
        $data=[];
        if($product->banner_status==1){
            if($banner_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->banner_status == 0) {
            if($banner_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['banner_status']=$status;
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('banner_list')."';</script>";
    }
}
