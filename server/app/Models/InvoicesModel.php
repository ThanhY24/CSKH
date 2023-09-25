<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesModel extends Model
{
    protected $table = 'tbl_invoices';
    protected $primaryKey = 'invoices_id';
    protected $fillable = [
        'invoices_date',
        'due_date',
        'invoices_total_amount',
        'payment_method',
        'staff_id',
        'cus_id',
        'invoices_status',
    ];
}
