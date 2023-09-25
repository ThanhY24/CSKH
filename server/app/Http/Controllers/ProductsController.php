<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProducts = ProductsModel::where('products_status', '<>', "0")
        ->join('tbl_services', 'tbl_products.ser_id', '=', 'tbl_services.ser_id')
        ->get();
        return response()->json(["data"=>$dataProducts], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function product_by_IDServices($idSer)
    {
        $dataProducts = ProductsModel::where('products_status', '<>', "0")
        ->where('tbl_products.ser_id', $idSer)
        ->get();
        return response()->json(["dataProducts"=>$dataProducts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProducts = $request->all();
        $product = new ProductsModel();
        $product->fill($dataProducts);
        if($product->save()){
            return response()->json(["message"=>"Đã thêm sản phẩm"], 200);
        }else{
            
            return response()->json(["message"=>"Đã xảy ra lỗi"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductsModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }else{
            return response()->json($product, 200);
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
        $products = ProductsModel::where('products_id', $id)->first();
        if(!$products){
            return response()->json(["message"=>"Sản phẩm không tồn tại"],203);
        }else{
            if ($products->update($request->all())) {
                return response()->json(["message" => "Cập nhật thành công"], 200);
            } else {
                return response()->json(["message" => "Đã xảy ra lỗi"], 500);
            }
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
