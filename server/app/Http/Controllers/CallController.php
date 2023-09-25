<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index(string $id){
        $customer = CustomerModel::find($id);
        $phoneNumber =  $customer["cus_phone"];
        if (strpos($phoneNumber, '0') === 0) {
            // Loại bỏ số "0" ở đầu và thêm "84"
            $formattedPhoneNumber = '84' . substr($phoneNumber, 1);
        } else {
            // Nếu số không bắt đầu bằng "0", giữ nguyên
            $formattedPhoneNumber = $phoneNumber;
        }
        return view("call")
        ->with("name", $customer["cus_name"])
        ->with("phone",$formattedPhoneNumber);
    }
}
