<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItemModel extends Model
{
    protected $table = 'tbl_quotation_item';
    protected $primaryKey = 'quotation_item_id';
    protected $fillable = [
        'quotation_id',
        'quotation_item_quantity',
        'quotation_item_vat',
        'quotation_products_cost',
        'products_id',
        'quotation_item_status',
    ];
}
