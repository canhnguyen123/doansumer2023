<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Http\Requests\validateRequet;
class chatController extends Controller
{
    public function chat_list(){
       
        $list = DB::table('tbl_chat')
            ->leftJoin('tbl_users', 'tbl_chat.user_id', '=', 'tbl_users.user_id')
            ->select('tbl_chat.user_id', DB::raw('MAX(tbl_chat.user_id) as max_id'), 'tbl_users.user_fullname', 'tbl_users.user_img')
            ->groupBy('tbl_chat.user_id', 'tbl_users.user_fullname', 'tbl_users.user_img')
            ->paginate(10);
    
        $manager_product = view('admin_include.page.chat.list')
        ->with('list_user', $list);
    return  view('admin')->with('admin_include.page.chat.list', $manager_product);
    }
    public function post_chat_list(Request $request){
        $staff_id=$request->staff_id;
        $user_id=$request->user_id;
        $context=$request->data;
        return  view('admin_include.page.chat.list');
    }
}
