<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\YourModel;

session_start();
class productController extends Controller
{
    public function product_list()
    {
        $list_product = DB::table("tbl_product")
        ->join("tbl_theloai", "tbl_product.theloai_id", "=", "tbl_theloai.theloai_id")
        ->select("tbl_product.*", "tbl_theloai.theloai_name")
        ->get();
        $count = DB::table("tbl_product")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_product = view('admin_include.page.product.product.list')
            ->with('list_product', $list_product)
            ->with('count', $count);
        return  view('admin')->with('admin_include.page.product.product.list', $manager_product);
    }
    public function product_deatil($product_id)
    {
            $product_detail = DB::table("tbl_product")
            ->join("tbl_theloai", "tbl_product.theloai_id", "=", "tbl_theloai.theloai_id")
            ->join("tbl_category", "tbl_theloai.category_id", "=", "tbl_category.category_id")
            ->join("tbl_phanloai", "tbl_theloai.phanloai_id", "=", "tbl_phanloai.phanloai_id")
            ->where('tbl_product.product_id', $product_id)
            ->select("tbl_product.*", "tbl_theloai.*", "tbl_category.*", "tbl_phanloai.*")
            ->get();
            $product_deatil_img=DB::table("tbl_list_img__product")
            ->where('product_id',$product_id)
            ->get();
            $product_deatil_quantity=DB::table("tbl_quantity_product")
            ->where('product_id',$product_id)
            ->get();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_product = view('admin_include.page.product.product.deatil')
            ->with('product_detail', $product_detail)
            ->with('product_deatil_img', $product_deatil_img)
            ->with('product_deatil_quantity', $product_deatil_quantity);
           
        return  view('admin')->with('admin_include.page.product.product.deatil', $manager_product);
    }
    public function product_add()
    {
        $list_category = DB::table("tbl_category")->orderBy("category_id", "asc")->where("category_status", 1)->get();
        $list_phanloai = DB::table("tbl_phanloai")->orderBy("phanloai_id", "asc")->where("phanloai_status", 1)->get();
        $list_size = DB::table("tbl_size")->orderBy("id_size", "asc")->where("status_size", 1)->get();
        $list_color = DB::table("tbl_color")->orderBy("color_id", "asc")->where("color_status", 1)->get();
        $list_brand = DB::table("tbl_brand")->orderBy("brand_id", "asc")->where("brand_status", 1)->get();
        $list_status_product = DB::table("tbl_status_product")->orderBy("status_id", "asc")->get();
        $manager_product = view('admin_include.page.product.product.add')
            ->with('list_category', $list_category)
            ->with('list_phanloai', $list_phanloai)
            ->with('list_size', $list_size)
            ->with('list_color', $list_color)
            ->with('list_brand', $list_brand)
            ->with('list_status_product', $list_status_product);
        return  view('admin')->with('admin_include.page.product.product.add', $manager_product);
    }
    public function post_product_add(Request $request)
    {
        $data = $data1 =$data2= [];
        $theloai_id = $request->input('theloai_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $brand_Product = $request->input('brand_Product');
        $trangthai_Product = $request->input('trangthai_Product');
        $product_code = $request->input('product_code');
        $mota_product = $request->input('mota_product');
        $dacdiem_product = $request->input('dacdiem_product');
        $baoquan_product = $request->input('baoquan_product');
        $quantity_list = $request->input('quantity_list');
        $imgs_item_product = $request->input('imgs_item_product');

        $quantity_list = json_decode($request->input('quantity_list'), true);
      // Kiểm tra xem dữ liệu đã tồn tại trong bảng tbl_product hay chưa
        $productExists = DB::table('tbl_product')
            ->where('product_code', $product_code)
            ->exists();

        if ($productExists) {
            // Dữ liệu đã tồn tại trong bảng tbl_product
            $errorMessage = "Dữ liệu đã tồn tại!";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
        $data['theloai_id'] = $theloai_id;
        $data['product_name'] = $product_name;
        $data['product_code'] = $product_code;
        $data['product_price'] = $product_price;
        $data['product_brand'] = $brand_Product;
        $data['product_status_Ha'] = $trangthai_Product;
        $data['product_mota'] = $mota_product;
        $data['product_dacdiem'] = $dacdiem_product;
        $data['product_baoquan'] = $baoquan_product;
        $data['product_status'] = 0;
        $data['created_at'] = Carbon::now();
        $inserted_Pro = DB::table('tbl_product')->insert($data);
        if ($inserted_Pro) {
            $product_id = DB::getPdo()->lastInsertId();

            foreach($imgs_item_product as $item=>$item_mg){
                $data1['product_id'] =  $product_id;
                $data1['img_name'] = $item_mg;
                 DB::table('tbl_list_img__product')->insert($data1);
            }
            foreach ($quantity_list as $item_quantity) {
                if (count($item_quantity) >= 3) {
                    $data2['product_id'] = $product_id;
                    $data2['quantity_color'] = $item_quantity[0];
                    $data2['quantity_size'] = $item_quantity[1];
                    $data2['quantity_sl'] = $item_quantity[2];
            
                    // Thực hiện câu truy vấn INSERT vào bảng tbl_quantity_product ở đây
                    DB::table('tbl_quantity_product')->insert($data2);
                    
                } 
            }
            return response()->json(['success' => true, 'message' => "Thêm thành công"]);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
        }
    }

    public function product_update($product_id)
    {   $select_product = DB::table("tbl_product")
        ->join("tbl_theloai", "tbl_product.theloai_id", "=", "tbl_theloai.theloai_id")
        ->join("tbl_category", "tbl_theloai.category_id", "=", "tbl_category.category_id")
        ->join("tbl_phanloai", "tbl_theloai.phanloai_id", "=", "tbl_phanloai.phanloai_id")
        ->where('tbl_product.product_id', $product_id)
        ->select("tbl_product.*", "tbl_theloai.*", "tbl_category.*", "tbl_phanloai.*")
        ->get();
        $product_deatil_img=DB::table("tbl_list_img__product")
        ->where('product_id',$product_id)
        ->get();
        $product_deatil_quantity=DB::table("tbl_quantity_product")
        ->where('product_id',$product_id)
        ->get();
        $list_category = DB::table("tbl_category")->orderBy("category_id", "asc")->where("category_status", 1)->get();
        $list_phanloai = DB::table("tbl_phanloai")->orderBy("phanloai_id", "asc")->where("phanloai_status", 1)->get();
        $list_size = DB::table("tbl_size")->orderBy("id_size", "asc")->where("status_size", 1)->get();
        $list_color = DB::table("tbl_color")->orderBy("color_id", "asc")->where("color_status", 1)->get();
        $list_brand = DB::table("tbl_brand")->orderBy("brand_id", "asc")->where("brand_status", 1)->get();
        $list_status_product = DB::table("tbl_status_product")->orderBy("status_id", "asc")->get();
        $manager_product = view('admin_include.page.product.product.update')
            ->with('list_category', $list_category)
            ->with('list_phanloai', $list_phanloai)
            ->with('list_size', $list_size)
            ->with('list_color', $list_color)
            ->with('list_brand', $list_brand)
            ->with('list_status_product', $list_status_product)
            ->with('select_product', $select_product)
            ->with('product_deatil_img', $product_deatil_img)
            ->with('product_deatil_quantity', $product_deatil_quantity);
         return  view('admin')->with('admin_include.page.product.product.update', $manager_product);
    }
    public function post_product_update(Request $request, $id_product)
    {
        $product = DB::table('tbl_product')->where('id_product', $id_product)->first();
        $status = 0;
        $data = [];
        if ($product->status_product == 1) {
            if ($request->status_product == "") {
                $status = 1;
            } else {
                $status = 0;
            }
        }
        if ($product->status_product == 0) {
            if ($request->status_product == "") {
                $status = 0;
            } else {
                $status = 1;
            }
        }
        $data['name_product'] = $request->product_name;
        $data['describle_product'] = $request->product_describl;
        $data['status_product'] = $status;


        DB::table('tbl_product')->where('id_product', $id_product)->update($data);
        Session::put('mess', 'Cập nhật danh mục sản phẩm thành công');
        return " <script> alert('Cập nhật thành công'); window.location = '" . route('product_list') . "';</script>";
    }
    public function product_delete($product_id)
{
    // Xóa các hàng trong bảng liên kết tbl_list_img__product
    DB::table('tbl_list_img__product')
        ->where('product_id', $product_id)
        ->delete();

    // Xóa các hàng trong bảng liên kết tbl_quantity_product
    DB::table('tbl_quantity_product')
        ->where('product_id', $product_id)
        ->delete();

    // Xóa hàng trong bảng tbl_product
    DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->delete();

    return "<script> alert('Xóa thành công'); window.location = '" . route('product_list') . "';</script>";
}
}
