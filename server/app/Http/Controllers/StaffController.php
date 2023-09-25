<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffModel;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataStaff = StaffModel::where('staff_status', '<>', "0")->get();
        return response()->json($dataStaff);
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
        $dataStaff = $request->all();

        // Mã hóa mật khẩu
        $hashedPassword = bcrypt($dataStaff['staff_password']);
        $dataStaff['staff_password'] = $hashedPassword;

        $staffModel = new StaffModel();
        $staffModel->fill($dataStaff);

        if ($staffModel->save()) {
            return response()->json(['message' => 'Đã thêm nhân viên']);
        } else {
            return response()->json(['message' => 'Thêm nhân viên thất bại']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staffModel = new StaffModel();

        $dataStaff  = $staffModel->find($id);
        return response()->json(['data'=>$dataStaff], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function export()
    {
        return response()->json(["message"=>"Hehehe"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = StaffModel::where('staff_id', $id)->first();
        if(!$staff){
            return response()->json(["message"=>"Khách hàng không tồn tại"],203);
        }else{
            if ($staff->update($request->all())) {
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
    public function hide_staff(string $id){
        $staff = StaffModel::where('staff_id', $id)->first();
        if(!$staff){
            return response()->json(["message"=>"Khách hàng không tồn tại"]);
        }else{
            if($staff->update(["staff_status"=> "0"])){
                return response()->json(['message' => 'Đã xóa khách hàng'], 200);
            }else{
                return response()->json(['message' => 'Đã xảy ra lỗi'], 500);
            }
        }
    }
    public function search(Request $request)
    {
        $query = StaffModel::query();
        
        // Kiểm tra và thêm điều kiện tìm kiếm theo staff_id
        if ($request->filled('staff_id')) {
            $query->where('staff_id', $request->staff_id);
        }

        // Kiểm tra và thêm điều kiện tìm kiếm theo staff_name
        if ($request->filled('staff_name')) {
            $query->where('staff_name', 'like', '%' . $request->staff_name . '%');
        }

        // Kiểm tra và thêm điều kiện tìm kiếm theo staff_address
        if ($request->filled('staff_address')) {
            $query->where('staff_address', 'like', '%' . $request->staff_address . '%');
        }

        // Kiểm tra và thêm điều kiện tìm kiếm theo staff_gender
        if ($request->filled('staff_gender')) {
            $query->where('staff_gender', $request->staff_gender);
        }
        $results = $query->get();
        return response()->json($results);
    }
}
