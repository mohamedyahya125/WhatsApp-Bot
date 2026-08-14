<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function register(RegisterRequest $request, UserService $userService)
    {

        $validate = $request->validated();
        $user = $userService->register($validate);
        return response()->json([
            'message' => 'تم انشاء الحساب بنجاح',
            'create' => $user
        ], 201);
    }
    public function login(LoginRequest $request, UserService $userService)
    {
        $validate = $request->validated();
        $user = $userService->login($validate);

        if (!$user) {
            return response()->json([
                'message' => 'البيانات غير صحيحة',
            ], 404);
        }
        return response()->json([
            'message' => 'تم الدخول بنجاح',
            'user' => $user
        ], 200);
    }
    public function logout(UserService $userService)
    {

        $userService->logout();
        return response()->json([
            'message' => 'تم تسجيل الخروج',
        ], 200);
    }
    public function show($id, UserService $userService)
    {
        $user = $userService->getuser($id);
        return response()->json([
            'user' => $user
        ], 200);
    }
}
