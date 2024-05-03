<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminLogin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(adminLogin $request)
    {
        $email='admin@admin.com';
        $password='admin@123';
        if($request->email == $email && $request->password == $password){
            return response()->json([
                'status' => 'success',
                'dashBoard' =>true,
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'dashBoard' => false,
            ], 401);
        }
    }
    public function logout(Request $request) {
        if(isset($request->logout)){
            return response()->json([
                'status' => 'success',
                'dashBoard' =>false,
            ]);
        }
    }
}
