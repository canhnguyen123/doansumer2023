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
        ->paginate(20);
        $list_category= DB::table('tbl_category')->where('category_status',1)->get();
        $list_phanloai= DB::table('tbl_phanloai')->where('phanloai_status',1)->get();
        $count = DB::table("tbl_product")->count();
        // $Tên biên=view('Đường dẫn vào file')->with('tên đường link',$tên biến khai báo bên trên);
        $manager_product = view('admin_include.page.product.product.list')
            ->with('list_product', $list_product)
            ->with('list_category',$list_category)
            ->with('list_phanloai',$list_phanloai)
            ->with('count', $count);
        return  view('admin')->with('admin_include.page.product.product.list', $manager_product);
    }
    public function quantityProduct_list($product_id)
    {
        $list_quantytyProduct = DB::table("tbl_quantity_product")
        ->where('product_id',$product_id)
        ->get();
        $list_size = DB::table("tbl_size")
        ->get();
        $list_color = DB::table("tbl_color")
        ->get();
        $deatilProduct = DB::table("tbl_product")
        ->where('product_id',$product_id)
        ->get();
        $manager_product = view('admin_include.page.product.product.quantity.quantity')
            ->with('list_quantytyProduct', $list_quantytyProduct)
            ->with('list_size', $list_size)
            ->with('list_color', $list_color)
            ->with('deatilProduct',$deatilProduct);
        return  view('admin')->with('admin_include.page.product.product.quantity.quantity', $manager_product);
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
        $mota_product = html_entity_decode($request->input('mota_product'));
        $dacdiem_product =html_entity_decode($request->input('dacdiem_product'));
        $baoquan_product =html_entity_decode($request->input('baoquan_product'));
        $quantity_list = $request->input('quantity_list');
        $imgs_item_product = $request->input('imgs_item_product');

        $quantity_list = json_decode($request->input('quantity_list'), true);
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
                    $data2['quantity_status']=0;
                    // Thực hiện câu truy vấn INSERT vào bảng tbl_quantity_product ở đây
                    DB::table('tbl_quantity_product')->insert($data2);
                    
                } 
            }
            return response()->json(['success' => true, 'message' => "Thêm thành công"]);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm không thành công']);
        }
    }
    public function post_quantity_add(Request $request,$product_id)
    {
        $data =[];
        $quantityProSize = $request->input('quantityProSize');
        $quantityProColor = $request->input('quantityProColor');
        $quantityPro = $request->input('quantityPros');
   
        $checkquantity = DB::table('tbl_quantity_product')
                ->where('quantity_size', $quantityProSize)
                ->where('quantity_color', $quantityProColor)
                ->where('product_id', $product_id )
                ->exists();

        if ($checkquantity) {
            // Dữ liệu đã tồn tại trong bảng tbl_product
            $errorMessage = "Số lượng tính theo size và màu sắc này đã tồn tại mời nhập lại";
            session()->flash('errorMessage', $errorMessage);
            return redirect()->back();
        }
        $data['quantity_size'] = $quantityProSize;
        $data['quantity_color'] = $quantityProColor;
        $data['quantity_sl'] = $quantityPro;
        $data['product_id'] = $product_id;
        $data['quantity_status'] = 0;
        $inserted_quan = DB::table('tbl_quantity_product')->insert($data);
        if ($inserted_quan) {
            return " <script> alert('Cập nhật thành công'); window.location = '" . route('quantityProduct_list', ['product_id' => $product_id]) . "';</script>";
        } else {
            return " <script> alert('Cập nhật thất bại'); window.location = '" . route('quantityProduct_list', ['product_id' => $product_id]) . "';</script>";
        }
    }

    // public function post_quantity_update(Request $request,$quantity_id)
    // {
    //     $data =[];
    //     $quantityProSize = $request->input('size');
    //     $quantityProColor = $request->input('color');
    //     $quantityPro = $request->input('quantity');
   
    //     // $checkquantity = DB::table('tbl_quantity_product')
    //     //         ->where('quantity_size', $quantityProSize)
    //     //         ->where('quantity_color', $quantityProColor)
    //     //         ->where('quantity_id','<>', $quantity_id )
    //     //         ->exists();

    //     // if ($checkquantity) {
    //     //     // Dữ liệu đã tồn tại trong bảng tbl_product
    //     //     $errorMessage = "Số lượng tính theo size và màu sắc này đã tồn tại mời nhập lại";
    //     //     session()->flash('errorMessage', $errorMessage);
    //     //     return redirect()->back();
    //     // }
    //     $data['quantity_size'] = $quantityProSize;
    //     $data['quantity_color'] = $quantityProColor;
    //     $data['quantity_sl'] = $quantityPro;
    //     $update = DB::table('tbl_quantity_product')->where('quantity_id',$quantity_id)->update($data);


    //     if ($update) {
    //         return response()->json(['status' =>'success', 'message' => "Sửa thành công"]);
    //     } else {
    //         return response()->json(['status' =>'fall', 'message' => "Sửa thất bại"]);
    //     }
    // }
    public function post_quantity_update(Request $request, $quantity_id)
    {
        $data = [];
        $quantityProSize = $request->input('size');
        $quantityProColor = $request->input('color');
        $quantityPro = $request->input('quantity');
    
        $checkquantity = DB::table('tbl_quantity_product')
                ->where('quantity_size', $quantityProSize)
                ->where('quantity_color', $quantityProColor)
                ->where('quantity_id','<>', $quantity_id )
                ->exists();

        if ($checkquantity) {
            // Dữ liệu đã tồn tại trong bảng tbl_product
            $errorMessage = "Số lượng tính theo size và màu sắc này đã tồn tại mời nhập lại";
            return response()->json(['status' => 'fall', 'message' => $errorMessage]);

        }
    
        $data['quantity_size'] = $quantityProSize;
        $data['quantity_color'] = $quantityProColor;
        $data['quantity_sl'] = $quantityPro;
        DB::table('tbl_quantity_product')->where('quantity_id', $quantity_id)->update($data);
        return response()->json(['status' => 'success', 'message' => "Sửa thành công"]);

     
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
    public function post_product_update(Request $request, $product_id)
    {
       $theloai_id=$request->input('phanloai_code_up');
       $product_name=$request->input('product_name_up');
       $product_code=$request->input('product_code_up');
       $product_price=$request->input('product_price_up');
       $brand_name=$request->input('brand_name_up');
       $status_product=$request->input('status_product_up');
       $mota_product=html_entity_decode($request->input('mota_product_up'));
       $dacdiem_product=html_entity_decode($request->input('dacdiem_product_up')); 
       $baoquan_product=html_entity_decode($request->input('baoquan_product_up'));
        $data = [];
       
        $data['theloai_id'] = $theloai_id;
        $data['product_name'] = $product_name;
        $data['product_code'] = $product_code;
        $data['product_price'] = $product_price;
        $data['product_brand'] = $brand_name;
        $data['product_status_Ha'] = $status_product;
        $data['product_mota'] = $mota_product;
        $data['product_dacdiem'] = $dacdiem_product;
        $data['product_baoquan'] = $baoquan_product;
 


        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('mess', 'Cập nhật danh mục sản phẩm thành công');
        return " <script> alert('Cập nhật thành công'); window.location = '" . route('product_list') . "';</script>";
    }
    public function togggle_status($product_id, $product_status){
        $product=DB::table('tbl_product')->where('product_id',$product_id)->first();
        $status=0;
        $data=[];
        if($product->product_status==1){
            if($product_status==0){
                $status=1;
            }else{
                $status=0;
            }
        }
         if ($product->product_status == 0) {
            if($product_status==1){
                $status=0;
            }else{
                $status=1;
            }
        }
        $data['product_status']=$status;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data); 
        return " <script> alert('Cập nhật thành công'); window.location = '".route('product_list')."';</script>";
    }
    public function togggle_status_quantity($quantity_id, $quantity_status, $product_id)
    {
        $toggle_quanti = DB::table('tbl_quantity_product')->where('quantity_status', $quantity_status)->first();
        $status = 0;
        $data = [];
    
        if ($toggle_quanti->quantity_status == 1) {
            if ($quantity_status == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
        }
    
        if ($toggle_quanti->quantity_status == 0) {
            if ($quantity_status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
        }
    
        $data['quantity_status'] = $status;
        $toggle = DB::table('tbl_quantity_product')->where('quantity_id', $quantity_id)->update($data);
    
        if ($toggle) {
            return " <script> alert('Cập nhật thành công'); window.location = '" . route('quantityProduct_list', ['product_id' => $product_id]) . "';</script>";
        } else {
            return " <script> alert('Cập nhật thất bại'); window.location = '" . route('quantityProduct_list', ['product_id' => $product_id]) . "';</script>";
        }
    }
    

}
