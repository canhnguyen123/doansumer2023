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
class Ajax_classController extends Controller
{
    public function ajax_category(Request $request){
        $keyword = $request->input('content');
    
        $categories = DB::table('tbl_category')
                        ->where('category_name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('category_code', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_category')->with('categories',$categories);
    }
    public function ajax_phanloai(Request $request){
        $keyword = $request->input('content');
    
        $phanloai = DB::table('tbl_phanloai')
                        ->where('phanloai_name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('phanloai_code', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_phanloai')->with('phanloai',$phanloai);
    }
    
    public function ajax_size(Request $request){
        $keyword = $request->input('content');
    
        $size = DB::table('tbl_size')
                        ->where('name_size', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('describle_size', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_size')->with('size',$size);
    }
    
    public function ajax_status(Request $request){
        $keyword = $request->input('content');
    
        $status = DB::table('tbl_status_product')
                        ->where('status_name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('status_code', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_status')->with('status',$status);
    }
    
    public function ajax_color(Request $request){
        $keyword = $request->input('content');
    
        $color = DB::table('tbl_color')
                        ->where('color_name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('color_code', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_color')->with('color',$color);
    }
    public function ajax_brand(Request $request){
        $keyword = $request->input('content');
    
        $brand = DB::table('tbl_brand')
                        ->where('brand_name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('brand_code', 'LIKE', '%' . $keyword . '%')
                        ->get();
        return view('ohther.ajax.admin.search_brand')->with('brand',$brand);
    }
    public function ajax_select_theloai(Request $request){
        $category_id = $request->input('category_id');
        $phanloai_id = $request->input('phanloai_id');
        $select_theloai = DB::table('tbl_theloai')
                        ->where('category_id',$category_id)
                        ->where('phanloai_id',$phanloai_id)
                        ->get();
         return response()->json($select_theloai);
    }
}
