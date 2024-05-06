<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
// use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(LoginAdminRequest $request)
    {
        $email='admin@admin.com';

        $password='admin@123';

        $admin = $request->email == $email && $request->password == $password;

        if($admin){
            return response()->json([
                'status' => 'success',
                'admin' => $admin,
            ]);
        }else{
            return response()->json([
                'status' => 'failed',
                'admin' => $admin,
            ], 401);
        }
    }
    public function logout() {
        return response()->json([
            'status' => 'success',
            'admin' => false,
        ]);
    }
}
