<?php

namespace App\Http\Controllers;

use Js;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\JWTServices;
use App\Services\UserService;
use App\Services\AuthServices;
use OpenApi\Attributes as OA; 
use App\Mail\ActivateUserEmail;
use App\Mail\SendPasswordEmail;
use Illuminate\Http\JsonResponse;
use App\Services\FcmTokenServices;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\PasswordRecoveryRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PasswordRecoveryUpdateRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    private AuthServices $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function login(LoginRequest $request): JsonResponse 
    {
        $data = $request->validated();

        try {
            $result = $this->authServices->login($data);
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->authServices->register($data['token']);
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }

    }

    public function logout(): JsonResponse
    {
        return response()->json(['message' => __('auth.logged out')], 200);
    }

    public function refreshToken(RefreshTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $result = $this->authServices->refreshToken($data['token']);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }

    public function whoami(): JsonResponse
    {
        return response()->json($this->authServices->whoami());
    }

}
