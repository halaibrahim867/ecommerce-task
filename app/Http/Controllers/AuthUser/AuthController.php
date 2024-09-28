<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repository\Authentication\AuthRepository;

class AuthController extends Controller
{

    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterUserRequest $request) {
        return $this->authRepository->register($request);
    }

    public function login(LoginUserRequest $request) {

        return $this->authRepository->login($request);
    }
}
