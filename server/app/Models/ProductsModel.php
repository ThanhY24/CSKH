<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'tbl_products';
    protected $primaryKey = 'products_id';
    protected $fillable = [
        "products_name",
        "products_image",
        "products_des",
        "products_cost",
        "products_syntax",
        "products_duration",
        "ser_id",
        "products_status",
    ];
}
