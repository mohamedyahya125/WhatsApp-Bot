<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register($data)
    {

        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function login($data)
    {

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return false;
        }
        if (!Hash::check($data['password'], $user->password)) {
            return false;
        }
        return $user;
    }
    public function logout()
    {
        return true;
    }
    public function getuser($id)
    {
        $show = User::find($id);
        return $show;
    }
}
