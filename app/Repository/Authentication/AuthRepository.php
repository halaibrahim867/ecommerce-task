<?php

namespace App\Repository\Authentication;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\Authentication\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    public function register(RegisterUserRequest $request)
    {
        $request->validate([$request->all()]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'is_admin'=>$request->is_admin,
            'phone'=>$request->phone,
        ]);

        return response()->json([
            'user'=>$user,
            'token'=>$user->createToken('API Token of '. $user->name)
        ]);

    }

    public function login(LoginUserRequest $request)
    {

        $user = User::where('email' , $request->email)->first();

        //check if doctor is not found or password not matched with password in DB
        if (!$user || !Hash::check($request->password, $user->password))
        {
            return response([
                'status' => true,
                'message' => 'Email or Password may be wrong, please try again'
            ]);
        }

        //create token
        return response()->json([
            'status'=>true,
            'message'=>'You are login Successfully',
            'token'=>$user->createToken('API Token of '. $user->name)
        ]);

    }
}
