<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSer = ServicesModel::where('ser_status', '<>', '0')
        ->join('tbl_services_group', 'tbl_services.ser_gr_id', '=', 'tbl_services_group.ser_gr_id')
        ->get();
        return response()->json($dataSer);
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
        $dataSer = $request->all();
        $ser = new ServicesModel();
        $ser->fill($dataSer);
        if($ser->save()){
            return response()->json(["message"=>"Đã thêm dịch vụ"], 200);
        }else{
            return response()->json(["message"=>"Đã xảy ra lỗi"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idSer)
    {
        $dataSer = ServicesModel::where('ser_status', '<>', '0')
        ->where('tbl_services.ser_id', $idSer)
        ->get();
        return response()->json(["data"=>$dataSer],200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicesModel $servicesModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServicesModel $servicesModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicesModel $servicesModel)
    {
        //
    }
}
