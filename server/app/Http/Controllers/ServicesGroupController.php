<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesGroupModel;
use App\Models\ServicesModel;

class ServicesGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSerGr = ServicesGroupModel::where('ser_gr_status', '<>', '0')->get();
        return response()->json($dataSerGr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getServicesGroupAndServices()
    {
        // Lấy danh sách tất cả nhóm dịch vụ
        $serviceGroups = ServicesGroupModel::where('ser_gr_status', '<>', '0')->get();

        // Lặp qua từng nhóm dịch vụ và lấy danh sách dịch vụ trong từng nhóm
        foreach ($serviceGroups as $group) {
            $group->services = ServicesModel::where('ser_gr_id', $group->ser_gr_id)->get();
        }

        return response()->json($serviceGroups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataSerGr = $request->all();
        $serGr = new ServicesGroupModel();
        $serGr->fill($dataSerGr);
        if($serGr->save()){
            return response()->json(["message"=>"Đã thêm nhóm dịch vụ"], 200);
        }else{
            return response()->json(["message"=>"Đã xảy ra lỗi"], 500);
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
