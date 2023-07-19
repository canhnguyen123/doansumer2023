<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        // Kiểm tra quyền truy cập của nhân viên dựa trên thông tin trong bảng tbl_phanquyendeatil_user
        $staff = Auth::user();

        if (!$staff) {
            // Nếu người dùng không đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login');
        }

        // Kiểm tra quyền của nhân viên trong bảng chung gian tbl_phanquyendeatil_user
        if ($staff->permissions()->where('phanquyenDeatil_Id', $permission)->exists()) {
            // Nếu có quyền, tiếp tục xử lý yêu cầu và chuyển tiếp đến Controller hoặc đích đến khác
            return $next($request);
        } else {
            // Nếu không có quyền, chuyển hướng đến trang "unauthorized"
            return redirect()->route('unauthorized');
        }
    }
}
