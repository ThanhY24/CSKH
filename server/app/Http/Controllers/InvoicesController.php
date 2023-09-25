<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoicesModel;
use App\Models\InvoicesItemModel;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;

class InvoicesController extends Controller
{
    public function create_invoices(Request $request){
        $dataInvoices = $request->input('dataInvoices');
        $dataInvoicesItem = $request->input('dataInvoicesItem');

        $invoices = new InvoicesModel();
        $invoices->fill($dataInvoices);
        $invoices->save();

        $invoicesID = $invoices->invoices_id;
        foreach ($dataInvoicesItem as $itemData) {
            $invoicesItem = new InvoicesItemModel();
            $invoicesItem->invoices_id = $invoicesID;
            unset($itemData["products_name"]);
            $invoicesItem->fill($itemData);
            $invoicesItem->save();
        }
        return response()->json(["message"=>"Thêm hóa đơn thành công"], 200);
    }
    public function get_invoices(){
        $dataInvoices = InvoicesModel::leftJoin('tbl_staff', 'tbl_invoices.staff_id', '=', 'tbl_staff.staff_id')
        ->leftJoin('tbl_customer', 'tbl_invoices.cus_id', '=', 'tbl_customer.cus_id')
        ->orderBy('tbl_invoices.created_at', 'desc')
        ->get();
        return response()->json(['data' => $dataInvoices], 200);
    }
    public function get_invoices_byID($id){
        $dataInvoices = InvoicesModel::leftJoin('tbl_staff', 'tbl_invoices.staff_id', '=', 'tbl_staff.staff_id')
        ->leftJoin('tbl_customer', 'tbl_invoices.cus_id', '=', 'tbl_customer.cus_id')
        ->where('tbl_invoices.invoices_id', $id)
        ->first();

        $invoices_id = $dataInvoices->invoices_id;

        $dataInvoicesItem = InvoicesItemModel::leftJoin('tbl_products', 'tbl_invoices_item.products_id', '=', 'tbl_products.products_id')
        ->where('tbl_invoices_item.invoices_id', $invoices_id)
        ->get();

        if (!$dataInvoices) {
            return response()->json(['message' => 'Quotation not found'], 404);
        }
        return response()->json(['dataInvoices' => $dataInvoices, 'dataInvoicesItem' => $dataInvoicesItem], 200);
    }
    public function testE_Invocies(Request $request){
        $url = 'https://testphunong-tt78admindemo.vnpt-invoice.com.vn/portalservice.asmx';
    
        $soapEnvelope = <<<XML
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <downloadInv xmlns="http://tempuri.org/">
            <invToken>1/001;C23TPP;00000027</invToken>
            <userName>testphunongservice</userName>
            <userPass>123456aA@</userPass>
            </downloadInv>
        </soap:Body>
        </soap:Envelope>
        XML;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapEnvelope);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapEnvelope)
        ));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            return response()->json(['message' => 'Lỗi cURL: ' . curl_error($ch)], 500);
        }else{
            return response()->json(['message' => 'Thành công', 'data' => $response]);
        }
        curl_close($ch);
    }
    public function import_EInvoices($invoices_id) {
    }
}
