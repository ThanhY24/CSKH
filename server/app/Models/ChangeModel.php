<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeModel extends Model
{
    protected $table = 'tbl_change';
    protected $primaryKey = 'change_id';
    protected $fillable = [
        'change_des',
        'change_start_date',
        'change_expected_date',
        'change_ratio',
        'cus_id',
        'staff_id',
        'products_id',
        'change_status',
    ];
}
