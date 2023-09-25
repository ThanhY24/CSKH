<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuotationModel;
use App\Models\QuotationItemModel;
use App\Models\CustomerModel;
use App\Models\StaffModel;
use App\Mail\QuotationEmail;

use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function get_quotation (){
        $dataQuotation = QuotationModel::leftJoin('tbl_staff', 'tbl_quotation.staff_id', '=', 'tbl_staff.staff_id')
        ->leftJoin('tbl_customer', 'tbl_quotation.cus_id', '=', 'tbl_customer.cus_id')
        ->orderBy('tbl_quotation.created_at', 'desc')
        ->get();

        return response()->json(['dataQuotation' => $dataQuotation], 200);
    }
    public function get_quotation_byIDCus($cus_id) {
        $dataQuotation = QuotationModel::leftJoin('tbl_staff', 'tbl_quotation.staff_id', '=', 'tbl_staff.staff_id')
            ->leftJoin('tbl_customer', 'tbl_quotation.cus_id', '=', 'tbl_customer.cus_id')
            ->where('tbl_quotation.cus_id', $cus_id)
            ->get();
    
        return response()->json(['dataQuotation' => $dataQuotation], 200);
    }
    public function create_quotation(Request $request){// Lấy dữ liệu từ request
        $dataQuotation = $request->input('dataQuotation');
        $dataQuotationItem = $request->input('dataQuotationItem');

        // Tạo một bản ghi mới trong bảng quotations
        $quotation = new QuotationModel();
        $quotation->fill($dataQuotation);
        $quotation->save();

        // Lấy ID của bản ghi vừa thêm
        $quotationId = $quotation->quotation_id;

        // Thêm các QuotationItem tương ứng vào bảng quotation_items
        foreach ($dataQuotationItem as $itemData) {
            $quotationItem = new QuotationItemModel();
            $quotationItem->quotation_id = $quotationId;
            unset($itemData["products_name"]);
            $quotationItem->fill($itemData);
            $quotationItem->save();
        }
        return response()->json(["message"=>"Thêm báo giá thành công", "quotation_id"=>$quotationId], 200);
    }
    public function copy_quotation(Request $request){// Lấy dữ liệu từ request
        $dataQuotation = $request->input('dataQuotationInsert');
        $dataQuotationItem = $request->input('dataQuotationItemCopy');

        // Tạo một bản ghi mới trong bảng quotations
        $quotation = new QuotationModel();
        $quotation->fill($dataQuotation);
        $quotation->save();

        // Lấy ID của bản ghi vừa thêm
        $quotationId = $quotation->quotation_id;

        // Thêm các QuotationItem tương ứng vào bảng quotation_items
        foreach ($dataQuotationItem as $itemData) {
            $quotationItem = new QuotationItemModel();
            $quotationItem->quotation_id = $quotationId;
            unset($itemData["products_name"]);
            $quotationItem->fill($itemData);
            $quotationItem->save();
        }
        return response()->json(["message"=>"Sao chép báo giá thành công", "quotation_id"=>$quotationId], 200);
    }
    public function get_quotation_byID($id)
    {
        $dataQuotation = QuotationModel::leftJoin('tbl_staff', 'tbl_quotation.staff_id', '=', 'tbl_staff.staff_id')
        ->leftJoin('tbl_customer', 'tbl_quotation.cus_id', '=', 'tbl_customer.cus_id')
        ->where('tbl_quotation.quotation_id', $id)
        ->first();

        $quotationId = $dataQuotation->quotation_id;

        $dataQuotationItem = QuotationItemModel::leftJoin('tbl_products', 'tbl_quotation_item.products_id', '=', 'tbl_products.products_id')
        ->where('tbl_quotation_item.quotation_id', $quotationId)
        ->get();

        if (!$dataQuotation) {
            return response()->json(['message' => 'Quotation not found'], 404);
        }
        return response()->json(['dataQuotation' => $dataQuotation, 'dataQuotationItem' => $dataQuotationItem], 200);
    }
    public function update_status($id){
        $quotation = QuotationModel::find($id);
        $toEmail = "lethanhy9999@gmail.com";
        $subject = "Test Email";
        $message = "This is a test email.";

        Mail::raw($message, function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)
                ->subject($subject);
        });

        if (!$quotation) {
            return response()->json(['message' => 'Báo giá không tồn tại'], 404);
        }

        $quotation->quotation_status = 0;
        $quotation->save();

        return response()->json(['message' => 'In thành công'], 200);
    }
    
    public function sendmail(Request $request, $idQuo){
        $dataQuotation = QuotationModel::find($idQuo);
        $dataCustomer = CustomerModel::where('cus_id', $dataQuotation->cus_id)->first();
        if ($request->has('image')) {
            $base64Image = $request->get('image');
            $imageData = base64_decode($base64Image);
            $imageName = 'BaoGia_'.time().'.'.'jpg';
            file_put_contents(public_path('images/' . $imageName), $imageData);
            Mail::to($dataCustomer->cus_email)->send(new QuotationEmail($imageData));
            return response()->json(['message' => "Đã gửi báo giá"], 200);
        } else {
            return response()->json(['message' => "Lỗi"], 500);
        }
    }
}
