<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TransactionModel extends Model
{
    protected $table = 'tbl_transaction';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        "transaction_name",
        "transaction_des",
        "transaction_evaluation",
        "transaction_note",
        "transaction_start_date",
        "transaction_deadline_date",
        "transaction_completion_date",
        "transaction_result_id",
        "staff_id",
        "cus_id",
        "change_id",
        "transaction_status",
    ];
}