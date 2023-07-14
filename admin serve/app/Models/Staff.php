<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'staff_name', 'staff_password',
    ];
    protected $hidden = [
        'staff_password',
    ];

    public function getAuthPassword()
    {
        return $this->staff_password;
    }

    public function getAuthIdentifier()
    {
        return $this->staff_id;
    }
}
