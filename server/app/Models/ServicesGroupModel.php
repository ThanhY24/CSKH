<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesGroupModel extends Model
{
    protected $table = 'tbl_services_group';
    protected $primaryKey = 'ser_gr_id';
    protected $fillable = [
        "ser_gr_name",
        "ser_gr_status",
    ];
}
