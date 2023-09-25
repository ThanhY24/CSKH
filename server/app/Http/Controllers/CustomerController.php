<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = CustomerModel::where('cus_status', '<>', "0")->get();
        return response()->json($customers);
    }

    public function upload_customers(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');

        if ($file->isValid()) {
            $filePath = $file->path();
            
            $rows = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath)->getActiveSheet()->toArray();

            foreach (array_slice($rows, 1) as $row) {
                $customer = [
                    'name' => $row[0],
                    'birthdate' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[3],
                    'tax_id' => $row[4],
                    'address' => $row[5],
                    'shipping_address' => $row[6],
                    'gender' => $row[7],
                ];

                // Thêm dữ liệu vào CSDL
                DB::table('customers')->insert($customer);
            }

            return response()->json(['message' => 'Customers imported successfully']);
        } else {
            return response()->json(['message' => 'Error uploading file'], 500);
        }
    }

    public function search(Request $request)
    {
        $query = CustomerModel::query();

        if ($request->has('cus_name')) {
            $query->where('cus_name', 'like', '%' . $request->input('cus_name') . '%');
        }

        if ($request->has('cus_id')) {
            $query->where('cus_id', $request->input('cus_id'));
        }

        if ($request->has('cus_address')) {
            $query->where('cus_address', 'like', '%' . $request->input('cus_address') . '%');
        }

        if ($request->has('cus_gender')) {
            $query->where('cus_gender', $request->input('cus_gender'));
        }

        $customers = $query->get();

        return response()->json(['data' => $customers, 'message' => 'Lấy danh sách khách hàng thành công'], 200);
    }
    public function store(Request $request)
    {
        $dataCustomer = $request->all();

        // Mã hóa mật khẩu
        $hashedPassword = bcrypt($dataCustomer['cus_password']);
        $dataCustomer['cus_password'] = $hashedPassword;

        $customerModel = new CustomerModel();
        $customerModel->fill($dataCustomer);

        if ($customerModel->save()) {
            return response()->json(['message' => 'Đã thêm khách hàng']);
        } else {
            return response()->json(['message' => 'Thêm khách hàng thất bại']);
        }
    }

    public function show(string $id)
    {
        $customer = CustomerModel::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }else{
            return response()->json($customer, 200);
        }
    }
    
    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $customer = CustomerModel::where('cus_id', $id)->first();

        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        $updated = $customer->update($request->all());

        if ($updated) {
            return response()->json(['message' => 'Cập nhật thành công'], 200);
        } else {
            return response()->json(['message' => 'Có lỗi xảy ra khi cập nhật'], 500);
        }
    }
    public function hide_customers(Request $request, string $id)
    {
        $customer = CustomerModel::where('cus_id', $id)->first();

        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }
    
        $updated = $customer->update([
            'cus_status' => "0"
        ]);
    
        if ($updated) {
            return response()->json(['message' => 'Đã xóa khách hàng'], 200);
        } else {
            return response()->json(['message' => 'Có lỗi xảy ra khi cập nhật'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        CustomerModel::destroy([$id]);

        return response()->json(['message' => 'Đã xóa khách hàng'], 200);
    }
}
