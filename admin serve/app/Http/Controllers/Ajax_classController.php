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

        $list_theloai = DB::table('tbl_phanloai')
        ->leftJoin('tbl_theloai', 'tbl_theloai.phanloai_id', '=', 'tbl_phanloai.phanloai_id')
        ->leftJoin('tbl_category', 'tbl_category.category_id', '=', 'tbl_theloai.category_id')
        ->select('tbl_theloai.*', 'tbl_category.category_name', 'tbl_phanloai.phanloai_name')
        ->orWhere('tbl_theloai.theloai_name', 'LIKE', '%' . $keyword . '%')
        ->get();
         return view('ohther.ajax.admin.search_theloai')->with('list_theloai', $list_theloai);
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
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $hoadon_status = 4; // Giả sử giá trị của $hoadon_status đã được định nghĩa
        $totalPrice = 0;
            $payment_list = DB::table('tbl_hoadon')
                ->where('status_payment_id', $hoadon_status)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
           

            foreach ($payment_list as $payment) {
                $totalPrice += $payment->hoadon_allprice;
            }
            $response_money="Đã bán được : ".number_format($totalPrice, 0, '.', ',')." VNĐ";
            $data = [
                'status' => "success",
                'totalPrice' => $response_money,
            ];
        
            return response()->json($data);
    }
}