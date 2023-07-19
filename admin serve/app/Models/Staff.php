<?php
// Staff.php
// Staff.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_staff';
    protected $primaryKey = 'id';
    protected $fillable = [
        'staff_username', 'staff_password',
    ];
    protected $hidden = [
        'staff_password',
    ];

    // Định nghĩa mối quan hệ với bảng chung gian tbl_phanquyendeatil_user
    public function permissions()
    {
        return $this->belongsToMany(PhanQuyenDeatil::class, 'tbl_phanquyendeatil_user', 'id', 'phanquyenDeatil_Id');
    }
}
