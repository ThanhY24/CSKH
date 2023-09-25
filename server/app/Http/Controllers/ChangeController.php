<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChangeModel;
use App\Models\TransactionResultModel;

class ChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataChange = ChangeModel::join('tbl_customer', 'tbl_customer.cus_id', '=', 'tbl_change.cus_id')
        ->join('tbl_products', 'tbl_products.products_id', '=', 'tbl_change.products_id')
        ->get();
        return response()->json($dataChange);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataChange = $request->all();
        $changeModel = new ChangeModel();
        $changeModel->fill($dataChange);

        if ($changeModel->save()) {
            return response()->json(['message' => 'Đã thêm cơ hội'],200);
        } else {
            return response()->json(['message' => 'Thêm cơ hội thất bại'],204);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $change = ChangeModel::find($id);
        if ($change) {
            // Nếu tìm thấy bản ghi, trả về dữ liệu JSON
            return response()->json($change);
        } else {
            // Nếu không tìm thấy, trả về thông báo lỗi
            return response()->json(['message' => 'Không tìm thấy thông tin change.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $change = ChangeModel::find($id);

        if (!$change) {
            return response()->json(['message' => 'Không tìm thấy thông tin change.'], 404);
        }

        // Update the fields based on the request data
        $change->change_name = $request->input('change_name');
        $change->change_des = $request->input('change_des');
        $change->change_start_date = $request->input('change_start_date');
        $change->change_expected_date = $request->input('change_expected_date');
        $change->change_ratio = $request->input('change_ratio');
        $change->cus_id = $request->input('cus_id');
        $change->change_status = $request->input('change_status');

        if ($change->save()) {
            return response()->json(['message' => 'Cập nhật cơ hội thành công.']);
        } else {
            return response()->json(['message' => 'Cập nhật cơ hội thất bại.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
