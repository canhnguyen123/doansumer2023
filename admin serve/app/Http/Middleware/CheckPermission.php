<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
            // Kiểm tra người dùng đã đăng nhập chưa
            $userId = Auth::id();
            $requestedRoute = $request->route()->getName(); // Lấy tên route của yêu cầu hiện tại
            
            $hasPermission = DB::table('tbl_phanquyendeatil_user')
                ->join('tbl_phanquyen_deatil', 'tbl_phanquyen_deatil.phanquyenDeatil_Id', '=', 'tbl_phanquyendeatil_user.phanquyenDeatil_Id')
                ->where('tbl_phanquyendeatil_user.id', $userId)
                ->where('tbl_phanquyen_deatil.phanquyenDeatil_route', $requestedRoute)
                ->where('tbl_phanquyen_deatil.phanquyenDeatil_status', 1)
                ->exists();
            
            if ($hasPermission) {
                // Nếu có quyền, tiếp tục xử lý yêu cầu và chuyển tiếp đến Controller hoặc đích đến khác
                return $next($request);
            }
            
            // Nếu không có quyền, chuyển hướng đến trang chủ (hoặc trang "unauthorized" tùy theo yêu cầu của bạn)
            return redirect()->route('home');
            
    }
}
