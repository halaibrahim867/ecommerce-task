<?php

namespace App\Interfaces\Authentication;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

interface AuthRepositoryInterface
{
    public function register(RegisterUserRequest $request);

    public function login(LoginUserRequest $request);

}
