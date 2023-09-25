<?php
namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function staff_login(Request $request)
    {
        $credentials = $request->validate([
            'staff_email' => 'required|email',
            'staff_password' => 'required',
        ]);
        if (Auth::guard('staff')->attempt(['staff_email'=>$credentials['staff_email'], 'password' =>$credentials['staff_password']])) {
            $user = Auth::guard('staff')->user();
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'dataUser' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin không hợp lệ',
            ]);
        }
    }
    public function staff_logout()
    {
        Auth::guard('staff')->logout();
        
        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công',
        ]);
    }
}
