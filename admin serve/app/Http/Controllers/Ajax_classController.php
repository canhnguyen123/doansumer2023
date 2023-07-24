<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Ajax_classController extends Controller
{
    public function ajax_category(Request $request)
    {
        $keyword = $request->input('content');

        $categories = DB::table('tbl_category')
            ->where('category_name', 'LIKE', '%' . $keyword . '%')
            ->orwhere('category_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_category')->with('categories', $categories);
    }
    public function ajax_phanloai(Request $request)
    {
        $keyword = $request->input('content');

        $phanloai = DB::table('tbl_phanloai')
            ->where('phanloai_name', 'LIKE', '%' . $keyword . '%')
            ->orwhere('phanloai_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_phanloai')->with('phanloai', $phanloai);
    }
    public function ajax_theloai(Request $request)
    {
        $keyword = $request->input('content');

        $list_theloai = DB::table('tbl_theloai')
            ->leftJoin('tbl_category', 'tbl_category.category_id', '=', 'tbl_theloai.category_id')
            ->leftJoin('tbl_phanloai', 'tbl_phanloai.phanloai_id', '=', 'tbl_theloai.phanloai_id')
            ->select('tbl_theloai.*', 'tbl_category.category_name', 'tbl_phanloai.phanloai_name')
            ->orWhere('tbl_theloai.theloai_name', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_theloai')->with('list_theloai', $list_theloai);
    }
    public function ajax_product(Request $request)
    {
        $keyword = $request->input('content');

        $list_product = DB::table("tbl_product")
            ->join("tbl_theloai", "tbl_product.theloai_id", "=", "tbl_theloai.theloai_id")
            ->select("tbl_product.*", "tbl_theloai.theloai_name")
            ->where("tbl_product.product_name", "LIKE", "%" . $keyword . "%")
            ->orWhere("tbl_product.product_code", "LIKE", "%" . $keyword . "%")
            ->orWhere("tbl_product.product_price", "LIKE", "%" . $keyword . "%")
            ->get();
        return view('ohther.ajax.admin.product_list')->with('list_product', $list_product);
    }
    public function ajax_size(Request $request)
    {
        $keyword = $request->input('content');

        $size = DB::table('tbl_size')
                ->where('name_size', 'LIKE', '%' . $keyword . '%')
                ->orwhere('describle_size', 'LIKE', '%' . $keyword . '%')
                ->get();
        return view('ohther.ajax.admin.search_size')->with('size', $size);
    }


    public function ajax_permission(Request $request)
    {
        $keyword = $request->input('content');
        $list_phanquyenDeatil = DB::table('tbl_phanquyen_deatil')
            ->join('tbl_phanquyen', 'tbl_phanquyen_deatil.phanquyen_id', '=', 'tbl_phanquyen.phanquyen_id')
            ->where('tbl_phanquyen_deatil.phanquyenDeatil_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tbl_phanquyen_deatil.phanquyenDeatil_route', 'LIKE', '%' . $keyword . '%')
            ->select('tbl_phanquyen_deatil.*', 'tbl_phanquyen.phanquyen_nameGroup')
            ->get();
        
        return view('ohther.ajax.admin.permission_list')->with('list_phanquyenDeatil', $list_phanquyenDeatil);
    }

    public function ajax_status(Request $request)
    {
        $keyword = $request->input('content');

        $status = DB::table('tbl_status_product')
            ->where('status_name', 'LIKE', '%' . $keyword . '%')
            ->orwhere('status_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_status')->with('status', $status);
    }

    public function ajax_color(Request $request)
    {
        $keyword = $request->input('content');

        $color = DB::table('tbl_color')
            ->where('color_name', 'LIKE', '%' . $keyword . '%')
            ->orwhere('color_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_color')->with('color', $color);
    }
    public function ajax_brand(Request $request)
    {
        $keyword = $request->input('content');

        $brand = DB::table('tbl_brand')
            ->where('brand_name', 'LIKE', '%' . $keyword . '%')
            ->orwhere('brand_code', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_brand')->with('brand', $brand);
    }
    public function ajax_user(Request $request)
    {
        $keyword = $request->input('content');

        $list_user = DB::table('tbl_users')
            ->where('user_phone', 'LIKE', '%' . $keyword . '%')
            ->orwhere('user_fullname', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('ohther.ajax.admin.search_user')->with('list_user', $list_user);
    }
    public function delete_quantity(Request $request)
    {
        $quantity_id = $request->input('quantity_id');
        $product_id = $request->input('product_id');
        $delete_quantity_id = DB::table('tbl_quantity_product')
            ->where('quantity_id', $quantity_id)
            ->delete();
        if ($delete_quantity_id) {
            $list_quantityNew = DB::table('tbl_quantity_product')->where('product_id', $product_id)->get();
            return response()->json(['success' => true, 'message' => "Xóa thành công", 'list_quantityNew' => $list_quantityNew]);
        } else {
            return response()->json(['success' => false, 'message' => "Xóa thất bại"]);
        }
    }
    public function ajax_select_theloai(Request $request)
    {
        $category_id = $request->input('category_id');
        $phanloai_id = $request->input('phanloai_id');
        $select_theloai = DB::table('tbl_theloai')
            ->where('category_id', $category_id)
            ->where('phanloai_id', $phanloai_id)
            ->get();
        return response()->json($select_theloai);
    }
    public function get_payment_status($hoadon_status)
    {
        $payment_list = DB::table('tbl_hoadon')
            ->where('status_payment_id', $hoadon_status)
            ->get();
        return view('ohther.ajax.admin.payment_list')->with('payment_list', $payment_list);
    }
    public function get_allPrice(Request $request)
    {
        $startDate = strtotime($request->input('startDate'));
        $endDate = strtotime($request->input('endDate'));
        $hoadon_status = 4;
        $totalPrice = 0;

        $payment_list = DB::table('tbl_hoadon')
            ->where('status_payment_id', $hoadon_status)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        foreach ($payment_list as $payment) {
            $totalPrice += $payment->hoadon_allprice;
        }

        $response_money = "Đã bán được: " . number_format($totalPrice, 0, '.', ',') . " VNĐ";

        $data = [
            'status' => "success",
            'totalPrice' => $response_money,
        ];

        return response()->json($data);
    }
    public function select_data_table(Request $request)
    {
        $product_theloai = $request->input('product_theloai');
        $product_status = $request->input('product_status');
        $product_min = $request->input('product_min');
        $product_max = $request->input('product_max');
        $is_filter_data = $request->input('is_filter_data');
        $is_status = $request->input('is_status');

        $product_list = DB::table('tbl_product')
            ->leftJoin('tbl_theloai', 'tbl_product.theloai_id', '=', 'tbl_theloai.theloai_id')
            ->where('tbl_product.theloai_id', $product_theloai);

        if ($is_status == 1) {
            if ($product_status != "all") {
                $product_list->where('tbl_product.product_status', $product_status);
            }
        }

        if ($is_filter_data == 1) {
            $product_list->whereBetween('tbl_product.product_price', [$product_min * 1000, $product_max * 1000]);
        }

        $product_list = $product_list->select('tbl_product.*', 'tbl_theloai.*')->get();

        return view('ohther.ajax.admin.product_list')->with('list_product', $product_list);
    }



    public function resetLoad()
    {
        $list_product = DB::table("tbl_product")
            ->join("tbl_theloai", "tbl_product.theloai_id", "=", "tbl_theloai.theloai_id")
            ->select("tbl_product.*", "tbl_theloai.theloai_name")
            ->get();
        return view('ohther.ajax.admin.product_list')->with('list_product', $list_product);
    }

    public function resetLoadpermission()
    {
        $list_phanquyenDeatil = DB::table('tbl_phanquyen_deatil')
            ->join('tbl_phanquyen', 'tbl_phanquyen.phanquyen_id', '=', 'tbl_phanquyen_deatil.phanquyen_id')
            ->select('tbl_phanquyen_deatil.*', 'tbl_phanquyen.phanquyen_nameGroup')
            ->paginate(10);
       
        return view('ohther.ajax.admin.permission_list')->with('list_phanquyenDeatil', $list_phanquyenDeatil);
    }

    public function resetLoadtheloai()
    {

        $list_theloai = DB::table('tbl_theloai')
            ->join('tbl_category', 'tbl_theloai.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_phanloai', 'tbl_theloai.phanloai_id', '=', 'tbl_phanloai.phanloai_id')
            ->select('tbl_theloai.*', 'tbl_category.category_name', 'tbl_phanloai.phanloai_name')
            ->get();
        return view('ohther.ajax.admin.search_theloai')->with('list_theloai', $list_theloai);
    }

    public function select_data_theloai(Request $request)
    {
        $category = $request->input('category');
        $phanloai = $request->input('phanloai');
        $status = $request->input('status');

        $product_list = DB::table('tbl_theloai')
            ->leftJoin('tbl_category', 'tbl_theloai.category_id', '=', 'tbl_category.category_id')
            ->leftJoin('tbl_phanloai', 'tbl_theloai.phanloai_id', '=', 'tbl_phanloai.phanloai_id')
            ->where('tbl_theloai.category_id', $category)
            ->where('tbl_theloai.phanloai_id', $phanloai);

        if ($status != "all") {
            $product_list->where('tbl_theloai.theloai_status', $status);
        }

        $list_theloai = $product_list->select('tbl_theloai.*', 'tbl_category.*', 'tbl_phanloai.*')->get();


        return view('ohther.ajax.admin.search_theloai')->with('list_theloai', $list_theloai);
    }

    public function select_data_user(Request $request)
    {
        $categoryUser = $request->input('categoryUser');
        $status = $request->input('status');

        $user_list = DB::table('tbl_users');
        if ($categoryUser != "all") {
            $user_list->where('user_accountCategory', $categoryUser);
        }
        if ($status != "all") {
            $user_list->where('user_status', $status);
        }

        $page = $request->input('page') ?? 1; // Trang mặc định là 1 nếu không được chỉ định

        $user_list_paginated = $user_list->paginate(20, ['*'], 'page', $page);

        // Render view và trả về kết quả
        $view = view('ohther.ajax.admin.search_user')
            ->with('list_user', $user_list_paginated)
            ->render();

        return response($view);
    }
    public function select_data_permission(Request $request)
    {
        $permission = $request->input('permission');
        $status = $request->input('status');
    
        $permission_list = DB::table('tbl_phanquyen_deatil')
            ->join('tbl_phanquyen', 'tbl_phanquyen_deatil.phanquyen_id', '=', 'tbl_phanquyen.phanquyen_id')
            ->select('tbl_phanquyen_deatil.*', 'tbl_phanquyen.phanquyen_nameGroup');
    
        if ($permission != "all") {
            $permission_list->where('tbl_phanquyen_deatil.phanquyen_id', $permission);
        }
    
        if ($status != "all") {
            $permission_list->where('tbl_phanquyen_deatil.phanquyenDeatil_status', $status);
        }
    
        $phanquyenDeatil_status = $permission_list->get();
        
        // Render view và trả về kết quả
        $view = view('ohther.ajax.admin.permission_list')
            ->with('list_phanquyenDeatil', $phanquyenDeatil_status)
            ->render();
    
        return response($view);
    }
    
    
    public function loadmore_category(Request $request)
    {
        $last_id = $request->input('last_id');
        $last_stt = $request->input('last_stt');
        
        // Truy vấn dữ liệu từ database thông qua Query Builder
        $list_category = DB::table('tbl_category')
            ->where('category_id', '>', $last_id)
            ->paginate(1);
        
        // Lấy tổng số bản ghi phù hợp với điều kiện where mà không bị giới hạn
        $total_records = $list_category->total();
        
        // Tính số thứ tự mới
        $new_stt = $last_stt + $total_records;
        
        // Lấy phần tử cuối cùng của Collection sử dụng phương thức last()
        $last_category_id = DB::table('tbl_category')
            ->orderByDesc('category_id')
            ->value('category_id');
        
        $hasMoreData = $list_category->hasMorePages();
        
        // Trả về tệp view Blade load_more_category.blade.php và dữ liệu JSON chứa biến bạn muốn sử dụng trong phạm vi JavaScript
        return Response::json([
            'view' => view('ohther.ajax.admin.search_category')->with('categories', $list_category)->with('i', $last_stt)->render(),
            'last_id' => $last_category_id,
            'hasMoreData' => $hasMoreData,
            'new_stt' => $new_stt,
        ]);
        
    }
}
