<?php

namespace App\Http\Controllers;
use App\Models\TransactionResultModel;

use Illuminate\Http\Request;

class TransactionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionResult = TransactionResultModel::where('transaction_result_status', '<>', "0")->get();
        return response()->json($transactionResult);
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
        $dataTransactionResult = $request->all();
        $transactionResultModel = new TransactionResultModel();
        $transactionResultModel->fill($dataTransactionResult);

        if ($transactionResultModel->save()) {
            return response()->json(['message' => 'Đã thêm kết quả'],200);
        } else {
            return response()->json(['message' => 'Thêm thất bại'],204);
        }
    }
        

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
