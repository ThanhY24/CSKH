<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'tbl_customer';
    protected $primaryKey = 'cus_id';
    protected $fillable = [
        'cus_name',
        'cus_birthday',
        'cus_gender',
        'cus_phone',
        'cus_email',
        'cus_password',
        'cus_total_cost',
        'cus_taxID',
        'cus_address',
        'cus_address_ship',
        'cus_status',
    ];

}