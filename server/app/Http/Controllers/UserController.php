<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    public function createUser(){
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->password = bcrypt('thanhy123');
        $user->save();
    }
    public function authUser(){
        // Thực hiện xác thực đăng nhập
        $credentials = [
            'email' => 'john@example.com',
            'password' => 'thanhy123',
        ];

        if (Auth::attempt($credentials)) {
            // Xác thực thành công
            echo "Đăng nhập thành công!";
        } else {
            // Xác thực thất bại
            echo "Đăng nhập thất bại!";
        }
    }
}
