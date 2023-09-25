<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionModel;
use App\Models\TransactionResultModel;
use App\Models\StaffModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Carbon as IlluminateCarbon;

class TransactionController extends Controller
{
    public function __construct(){
        $dataTransactionTest = TransactionModel::join('tbl_staff', 'tbl_transaction.staff_id', '=', 'tbl_staff.staff_id')
        ->join('tbl_customer', 'tbl_transaction.cus_id', '=', 'tbl_customer.cus_id')
        ->leftJoin('tbl_transaction_result', 'tbl_transaction.transaction_result_id', '=', 'tbl_transaction_result.transaction_result_id')
        ->select('tbl_transaction.*', 'tbl_staff.*', 'tbl_customer.*', 'tbl_transaction_result.*')
        ->where('tbl_transaction.transaction_id', '=', '1') // Thêm điều kiện này để loại trừ transaction_id = 3
        ->orderBy('tbl_transaction.created_at', 'desc')
        ->get();


        foreach ($dataTransactionTest as $transaction) {
            if($transaction->transaction_status !== 0){
                $transactionDeadline = Carbon::parse($transaction->transaction_deadline_date);
                $currentDate = Carbon::now();

                if ($transactionDeadline < $currentDate) {
                    $status = "Đã hết hạn";
                    $newStatus = 2; // Cập nhật trạng thái mới nếu đã hết hạn
                } else {
                    $status = "Chưa hết hạn";
                    $newStatus = $transaction->transaction_status; // Giữ nguyên trạng thái nếu chưa hết hạn
                }

                // Cập nhật trạng thái mới vào cơ sở dữ liệu
                TransactionModel::where('transaction_id', $transaction->transaction_id)
                    ->update(['transaction_status' => $newStatus]);
            }
        }
    }

    public function index()
    {   
        // Lấy toàn bộ dữ liệu giao dịch
        $dataTransaction = TransactionModel::join('tbl_staff', 'tbl_transaction.staff_id', '=', 'tbl_staff.staff_id')
        ->join('tbl_customer', 'tbl_transaction.cus_id', '=', 'tbl_customer.cus_id')
        ->leftJoin('tbl_transaction_result', 'tbl_transaction.transaction_result_id', '=', 'tbl_transaction_result.transaction_result_id')
        ->select('tbl_transaction.*', 'tbl_staff.*', 'tbl_customer.*', 'tbl_transaction_result.*')
        ->orderBy('tbl_transaction.created_at', 'desc')
        ->get();
        return response()->json($dataTransaction);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data["dataInsertTransaction"])) {
            $dataTransaction = $data["dataInsertTransaction"];
            if($data["sendMail"] == 1){
                $staff_id = $dataTransaction["staff_id"];
                $staff = StaffModel::find($staff_id);

                if ($staff) {
                    $staff_email = $staff->staff_email;

                    $transactionModel = new TransactionModel();
                    $transactionModel->fill($dataTransaction);
                    
                    if ($transactionModel->save()) {
                        $combinedData = [
                            'staff' => $staff ? $staff->toArray() : null,
                            'transaction' => $transactionModel->toArray(),
                        ];
                        Mail::to($staff_email)->send(new TransactionEmail($combinedData));
                        return response()->json(['message' => "Đã thêm giao dịch"], 200);
                    } else {
                        return response()->json(['message' => 'Thêm giao dịch thất bại'], 204);
                    }
                } else {
                    return response()->json(['message' => 'Không tìm thấy nhân viên với staff_id đã cho'], 404);
                }
            }else{
                $transactionModel = new TransactionModel();
                    $transactionModel->fill($dataTransaction);
                    
                    if ($transactionModel->save()) {
                        return response()->json(['message' => "Đã thêm giao dịch"], 200);
                    } else {
                        return response()->json(['message' => 'Thêm thất bại'], 204);
                    }
            }
        } else {
            return response()->json(['message' => 'Không tồn tại key "dataInsertTransaction" trong dữ liệu'], 400);
        }
    }

    public function show(string $id)
    {
        $transaction = TransactionModel::find($id);
        return response()->json($transaction);
    }

    public function copy(string $id)
    {
        $originalTransaction = TransactionModel::find($id);

        if (!$originalTransaction) {
            return response()->json(['message' => 'Không tìm thấy giao dịch gốc'], 404);
        }

        $newTransactionData = $originalTransaction->toArray();
        $newTransactionData['transaction_status'] = 1;
        $newTransactionData['transaction_note'] = null;
        $newStartDate = now();
        $newDeadlineDate = now()->addDays(7);
        $newTransactionData['transaction_start_date'] = $newStartDate;
        $newTransactionData['transaction_deadline_date'] = $newDeadlineDate;

        $newTransaction = TransactionModel::create($newTransactionData);

        return response()->json(['message' => $newTransaction->id], 201);
    }
    public function update_status(Request $request, string $id)
    {
        $transaction = TransactionModel::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Giao dịch không tồn tại'], 404);
        }

        $transaction_result_id = $request->input('transaction_result_id');
        $newStatus = '0';
        $transaction->transaction_status = $newStatus;
        $transaction->transaction_result_id = $transaction_result_id;
        $transaction->transaction_completion_date = Carbon::now(); 

        $transaction->save();

        return response()->json(['message' => 'Thực hiện thành công']);
    }
    public function delete(string $id)
    {
        $transaction = TransactionModel::where('transaction_id', $id)->first();
        if (!$transaction) {
            return response()->json(['message' => 'Giao dịch không tồn tại'], 404);
        }
        // Cập nhật trạng thái của giao dịch thành '3'
        $transaction['transaction_status'] = 3;
        if ($transaction->save()) {
            return response()->json(['message' => 'Đã xóa giao dịch']);
        } else {
            return response()->json(['message' => 'Không thể xóa giao dịch'], 500);
        }
    }


    public function transfer(Request $request)
    {
        $transactionModel = new TransactionModel();
        $staffModel = new StaffModel();
        
        $dataTransfer = $request->all();
        $transactionID  = $dataTransfer["transaction_id"];
        $staffID  = $dataTransfer["staff_id"];
        $staff = $staffModel->find($staffID);
        
        if ($staff) {
            $currentStaffID = $transactionModel->find($transactionID)->staff_id;
            $currentStaff = $staffModel->find($currentStaffID);
            $currentStaffName = $currentStaff->staff_name;
            
            $newStaffName = $staff->staff_name;
            $transaction = $transactionModel->find($transactionID);
            if ($transaction) {
                $existingNote = $transaction->transaction_note;
                $newNote = $currentStaffName . " => " . $newStaffName;
                
                if ($existingNote) {
                    $transaction->transaction_note = $existingNote . "," . $newNote;
                } else {
                    $transaction->transaction_note = $newNote;
                }
                
                $transaction->save();
                
                // Cập nhật lại staffID và staff_id trong tbl_transaction
                $transaction->staff_id = $staffID;
                $transaction->save();
                
                return response()->json(["data" => "Chuyển giao thành công"]);
            }
            
            return response()->json(["error" => "Lỗi roài fenn ơi"], 404);
        }
        
        return response()->json(["error" => "Lỗi roài fenn ơi"], 404);
    }
    public function get_data_transaction_statistical(Request $request,string $id){
        $dataTransaction = TransactionModel::join('tbl_transaction_result', 'tbl_transaction.transaction_result_id', '=', 'tbl_transaction_result.transaction_result_id')
        ->where('tbl_transaction.staff_id', '=', $id)
        ->where('tbl_transaction.transaction_status', '<>', '3')
        ->get();
        $dataTransactionNoID = TransactionModel::join('tbl_transaction_result', 'tbl_transaction.transaction_result_id', '=', 'tbl_transaction_result.transaction_result_id')
        ->where('tbl_transaction.transaction_status', '<>', '3')
        ->get();
        $dataTransactionResult = TransactionResultModel::get();
        return response()
        ->json(["dataTransaction"=>$dataTransaction,
                "dataTransactionResult"=>$dataTransactionResult,
                "dataTransactionNoID"=>$dataTransactionNoID]);
    }
}