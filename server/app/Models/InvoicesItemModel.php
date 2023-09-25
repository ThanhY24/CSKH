<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesItemModel extends Model
{
    protected $table = 'tbl_invoices_item';
    protected $primaryKey = 'invoices_item_id';
    protected $fillable = [
        'invoices_id',
        'invoices_item_quantity',
        'invoices_item_vat',
        'products_id',
        "products_cost",
        'invoices_item_status',
    ];
}
