<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

session_start();

class statisticalController extends Controller
{
    public function statistical(){
        return  view('admin_include.page.statistical.statistical');
    }

}
