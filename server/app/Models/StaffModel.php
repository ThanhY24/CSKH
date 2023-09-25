<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StaffModel extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'tbl_staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        "staff_name",
        "staff_birthday",
        "staff_gender",
        "staff_phone",
        "staff_email",
        "staff_password",
        "staff_address",
        "staff_position",
        "staff_role",
        "staff_status",
    ];

    protected $hidden = [
        'staff_password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAuthPassword() {
        return $this->staff_password;
    }
    
}
