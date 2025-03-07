<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Services\ClientServices;
use App\Services\CompanyServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\InitializeClientRequest;
use App\Http\Requests\ClientCreateCompanyRequest;

class ClientController extends Controller
{
    private ClientServices $clientServices;
    private UserServices $userServices;
    public function __construct(ClientServices $clientServices, UserServices $userServices)
    {
        $this->clientServices = $clientServices;
        $this->userServices = $userServices;
        $this->user = $this->userServices->userWithCompany();
    }

    public function dashboard(): JsonResponse
    {
        $result = $this->clientServices->dashboard($this->user);

        return response()->json($result, 200);
    }


    public function initializeClientData(InitializeClientRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $result = $this->clientServices->initializeClientData($data);
            return response()->json('Success creating from blueprints' , 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error on creating from blueprints'
            ] ,  $e->getCode() ?: 500);
        }
    }
}
