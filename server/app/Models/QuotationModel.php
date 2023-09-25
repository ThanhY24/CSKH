<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationModel extends Model
{
    protected $table = 'tbl_quotation';
    protected $primaryKey = 'quotation_id';
    protected $fillable = [
        'quotation_created_date',
        'quotation_due_date',
        'quotation_des',
        'staff_id',
        'cus_id',
        'quotation_status',
    ];
    
}
