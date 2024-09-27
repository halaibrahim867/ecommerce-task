<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\Authentication\AuthRepositoryInterface;
use App\Models\User;
use App\Repository\Authentication\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
