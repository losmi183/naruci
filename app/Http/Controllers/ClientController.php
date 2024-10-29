<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ClientServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\InitializeClientRequest;
use App\Http\Requests\ClientCreateCompanyRequest;

class ClientController extends Controller
{
    private ClientServices $clientServices;
    public function __construct(ClientServices $clientServices)
    {
        $this->clientServices = $clientServices;
    }

    public function createCompany(ClientCreateCompanyRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->clientServices->createCompany($data);
            return response()->json($result , 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
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
