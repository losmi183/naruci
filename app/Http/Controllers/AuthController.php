<?php

namespace App\Http\Controllers;

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

    public function login(Request $request): JsonResponse 
    {
        $data = $request->validate([
            'email' => 'required|email|',
            'password' => 'required|string',
        ]);

        $result = $this->authServices->login($data);

        return response()->json($result);
    } 

}
