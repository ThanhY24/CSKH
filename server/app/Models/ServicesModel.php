<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    protected $table = 'tbl_services';
    protected $primaryKey = 'ser_id';
    protected $fillable = [
        "ser_name",
        "ser_status",
        "ser_gr_id",
    ];
}
