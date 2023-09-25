<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionResultModel extends Model
{
    protected $table = 'tbl_transaction_result';
    protected $primaryKey = 'transaction_result_id';
    protected $fillable = [
        "transaction_result_name",
        "transaction_result_status",
    ];
}
